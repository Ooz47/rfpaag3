<?php

namespace Drupal\reseau_mod_up_webform_dir_ggp\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\webform\Entity\WebformSubmission;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WebformSubmissionChangerStatutDir_ggpController.
 *
 * @package Drupal\reseau_mod_up_webform_dir_ggp\Controller
 */
class WebformSubmissionChangerStatutDir_ggpController extends ControllerBase
{

  /**
   * Approve method.
   *
   * @param \Drupal\webform\Entity\WebformSubmission $submission
   *   A webform submission.
   * @param \Symfony\Component\HttpFoundation\Request $request
   *   The current HTTP request.
   *
   * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
   *   The response.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  
  public function marquerCloture(WebformSubmission $submission, Request $request)
  {

    $timezone = new \DateTimeZone('America/Guadeloupe');
    $now = DrupalDateTime::createFromTimestamp(time(), $timezone);

    $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
    $submission->setElementData('statut', 'Cloturé');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Cloturé', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }

  public function marquerEncours(WebformSubmission $submission, Request $request)
  {

    $submission->setElementData('traite_le', '');
    $submission->setElementData('statut', 'En cours');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: En cours.', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }

  /**
   * Checks access for a specific request.
   *
   * @return \Drupal\Core\Access\AccessResult
   *   The access result.
   *
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function access(WebformSubmission $submission)
  {
    return AccessResult::allowedIf(!$submission->isDraft() && array_intersect(array('administrator', 'gestionnaire_incidents_reclamation_ggp', 'webmaster_reseau'), $this->currentUser()->getRoles()) !== []);
  }
}
