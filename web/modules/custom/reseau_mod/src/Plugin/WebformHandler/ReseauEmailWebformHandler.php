<?php

namespace Drupal\reseau_mod\Plugin\WebformHandler;

use Drupal\webform\Plugin\WebformHandler\EmailWebformHandler;
use Drupal\webform\WebformSubmissionInterface;

/**
 * Emails a webform submission.
 *
 * @WebformHandler(
 *   id = "destinataire_formation_email",
 *   label = @Translation("Destinataires formation email"),
 *   category = @Translation("Notification"),
 *   description = @Translation("envoie les données du formulaire aux contacts indiqués sur la fiche formation à l'exception des référents handicap."),
 *   cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_UNLIMITED,
 *   results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
 * )
 */
class ReseauEmailWebformHandler extends EmailWebformHandler
{

  public function sendMessage(WebformSubmissionInterface $webform_submission, array $message)
  {

    $formation_id = $webform_submission->getElementData('objet');
    // dsm(getElementData('objet'));
    $destinataires = get_contacts_formation($formation_id);
    
    if (!empty($destinataires)) {
      $recipient = implode(", ", $destinataires);
    } else {
      //définir adresse par default
      $recipient = 'contact@koncept47.com';
    }

    $message['to_mail'] = $recipient;

    parent::sendMessage($webform_submission, $message);
  }
}
