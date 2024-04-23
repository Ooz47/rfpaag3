<?php

namespace Drupal\reseau_mod_up_webform_dir_ggp\Plugin\WebformHandler;

use Drupal\webform\Plugin\WebformHandler\EmailWebformHandler;
use Drupal\webform\WebformSubmissionInterface;

/**
 * Emails a webform submission.
 *
 * @WebformHandler(
 *   id = "destinataire_reclamations_email_gretagp",
 *   label = @Translation("Destinataires réclamations email pour le Greta Guadeloupe"),
 *   category = @Translation("Notification"),
 *   description = @Translation("envoie les données du formulaire de réclamations au DO/DA"),
 *   cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_UNLIMITED,
 *   results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
 * )
 */
class GretaGpReclamationsEmailWebformHandler extends EmailWebformHandler
{

  public function sendMessage(WebformSubmissionInterface $webform_submission, array $message)
  {


    $role = 'gestionnaire_incidents_reclamation_ggp';

    $fonction = 'do_da';
    $destinataires = get_users_email_with_fonction($role, $fonction);

    if (!empty($destinataires)) {
      $recipient = implode(", ", $destinataires);
    } else {
      //définir adresse par default
      $recipient = 'contact@koncept47.com';
    }

    $message['to_mail'] = $recipient;

    parent::sendMessage($webform_submission, $message);
    // parent::sendMessage($webform_submission, $message);
  }
}
