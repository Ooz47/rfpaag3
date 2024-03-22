<?php

namespace Drupal\reseau_mod_up_webform\Plugin\WebformHandler;

use Drupal\webform\Plugin\WebformHandler\EmailWebformHandler;
use Drupal\webform\WebformSubmissionInterface;

/**
 * Emails a webform submission.
 *
 * @WebformHandler(
 *   id = "destinataire_formation_email_gretagp",
 *   label = @Translation("Destinataires formation email pour le Greta Guadeloupe"),
 *   category = @Translation("Notification"),
 *   description = @Translation("envoie les données du formulaire aux contacts prédéfinis selon l'objet selectionné"),
 *   cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_UNLIMITED,
 *   results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
 * )
 */
class GretaGpEmailWebformHandler extends EmailWebformHandler
{

  public function sendMessage(WebformSubmissionInterface $webform_submission, array $message)
  {
    // dsm($webform_submission);
    // dsm($webform_submission->getElementData('objet_select'));
   $objet = $webform_submission->getElementData('objet_select');
    // $formation_id = $webform_submission->getElementData('objet');
    // // dsm(getElementData('objet'));
    // $destinataires = get_contact_gretagp_formation($formation_id);
    
    if (!empty($objet)) {
    if ($objet == 'S\'inscrire en apprentissage') {
      $recipient = 'apprentissage@gretaguadeloupe.fr';
    } else {
      
      $recipient = 'contact@gretaguadeloupe.fr';
    }
    } else {
      //définir adresse par default
      $recipient = 'contact@koncept47.com';
    }

    $message['to_mail'] = $recipient;

    parent::sendMessage($webform_submission, $message);
  }
}
