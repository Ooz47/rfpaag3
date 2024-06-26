<?php

namespace Drupal\entity_pdf\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\Controller\EntityViewController;
use Drupal\Core\Session\AccountInterface;
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;
use Mpdf\Mpdf;
use Drupal\Core\Entity\EntityInterface;
use Mpdf\Output\Destination;
use Symfony\Component\HttpFoundation\Response;

/**
 * Defines a controller to render a single entity.
 */
class PdfEntityController extends EntityViewController {

  /**
   * Public function view.
   */
  public function view(EntityInterface $entity, $view_mode = 'full', $langcode = NULL) {
    global $base_url;

    $build = [
      '#theme' => 'htmlpdf',
      '#title' => $entity->label(),
      '#content' => parent::view($entity, $view_mode, $langcode),
      '#base_url' => $base_url,
      '#langcode' => $langcode,
    ];

    $output = \Drupal::service('renderer')->render($build);

    // If you want the test HTML output, uncomment this:
    // return new Response(render($build), 200, []);

    // Get the filename from config and replace tokens.
    $configFactory = \Drupal::service('config.factory');
    $config = $configFactory->get('entity_pdf.settings');
    $filename = \Drupal::token()->replace($config->get('filename'), [$entity->getEntityTypeId() => $entity], ['langcode' => $langcode]);

    // Get mpdf's default config and allow other modules to alter it.
    $mpdf_config = [];
    $mpdf_config['tempDir'] = DRUPAL_ROOT . '/' . $config->get('tempDir');
    $defaultConfig = (new ConfigVariables())->getDefaults();
    $mpdf_config['fontDir'] = $defaultConfig['fontDir'];
    $defaultFontConfig = (new FontVariables())->getDefaults();
    $mpdf_config['fontdata'] = $defaultFontConfig['fontdata'];
    $mpdf_config['autoScriptToLang'] = TRUE;
    $mpdf_config['autoLangToFont'] = TRUE;
    \Drupal::moduleHandler()->alter('mpdf_config', $mpdf_config);

    // Build and return the pdf.
    $mpdf = new Mpdf($mpdf_config);
    $mpdf->SetBasePath(\Drupal::request()->getSchemeAndHttpHost());
    $mpdf->SetTitle($filename);
    $mpdf->WriteHTML($output);
    $content = $mpdf->Output($filename, Destination::STRING_RETURN);

    // Decide if content is sent to browser or downloaded.
    $openInBrowser = !!$config->get('openInBrowser');
    $contentDisposition = !!$openInBrowser || \Drupal::request()->query->get('inline') == 1 ? 'inline' : 'attachment';
    $headers = [
      'Content-Type' => 'application/pdf',
      'Content-disposition' => $contentDisposition . '; filename="' . $filename . '"',
    ];

    return new Response($content, 200, $headers);
  }

  /**
   * Public function title.
   *
   * @inheritdoc
   */
  public function title(EntityInterface $entity) {
    return $entity->label();
  }

  /**
   * Checks access for a specific request.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   Run access checks for this account.
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity object.
   * @param string $view_mode
   *   The view mode.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function access(AccountInterface $account, EntityInterface $entity, string $view_mode = 'full') {
    return AccessResult::allowedIf(
      $account->hasPermission('view entity pdf') ||
      $account->hasPermission('view ' . $entity->getEntityTypeId() . '.' . $entity->bundle() . '.' . $view_mode . ' pdf')
    );
  }

}
