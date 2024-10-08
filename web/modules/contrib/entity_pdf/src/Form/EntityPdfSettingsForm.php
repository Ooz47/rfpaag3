<?php

namespace Drupal\entity_pdf\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class EntityPdfSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'entity_pdf_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'entity_pdf.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('entity_pdf.settings');

    $form['filename'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Filename for generated PDF documents.'),
      '#default_value' => $config->get('filename') ?: '[node:nid].pdf',
      '#description' => $this->t('You can use node tokens.'),
    ];

    $form['tempDir'] = [
      '#type' => 'textfield',
      '#title' => $this->t('tempDir: DRUPAL_ROOT/'),
      '#default_value' => $config->get('tempDir') ?: 'sites/default/files/entity_pdf',
      '#description' => $this->t('Do not include a leading slash.'),
    ];

    $form['openInBrowser'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Open in browser'),
      '#default_value' => $config->get('openInBrowser') ?: FALSE,
      '#description' => $this->t('Open in the browser instead of downloading. Can be reverted in specific cases by adding ?inline=1 to a pdf links'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('entity_pdf.settings');
    $config->set('filename', $form_state->getValue('filename'));
    $config->set('tempDir', $form_state->getValue('tempDir'));
    $config->set('openInBrowser', $form_state->getValue('openInBrowser'));
    $config->save();
    parent::submitForm($form, $form_state);
  }

}
