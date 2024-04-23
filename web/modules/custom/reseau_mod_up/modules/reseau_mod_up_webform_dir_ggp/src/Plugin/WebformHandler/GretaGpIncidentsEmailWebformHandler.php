<?php

namespace Drupal\reseau_mod_up_webform_dir_ggp\Plugin\WebformHandler;

use Drupal\webform\Plugin\WebformHandler\EmailWebformHandler;
use Drupal\webform\WebformSubmissionInterface;

/**
 * Emails a webform submission.
 *
 * @WebformHandler(
 *   id = "destinataire_incidents_email_gretagp",
 *   label = @Translation("Destinataires incidents email pour le Greta Guadeloupe"),
 *   category = @Translation("Notification"),
 *   description = @Translation("envoie les données du formulaire incidents aux destinataires concernés"),
 *   cardinality = \Drupal\webform\Plugin\WebformHandlerInterface::CARDINALITY_UNLIMITED,
 *   results = \Drupal\webform\Plugin\WebformHandlerInterface::RESULTS_PROCESSED,
 * )
 */
class GretaGpIncidentsEmailWebformHandler extends EmailWebformHandler
{

  public function sendMessage(WebformSubmissionInterface $webform_submission, array $message)
  {

// dsm($webform_submission);
$nature_dysfonctionnement = $webform_submission->getElementData('nature_dysfonctionnement');

// dsm($nature_dysfonctionnement);
// $role = 'gestionnaire_dir_ggp_do_da';
$role = 'gestionnaire_incidents_reclamation_ggp';
$fonction = 'do_da';

switch ($nature_dysfonctionnement) {
  case 'prob_informatique':
    // $role = 'gestionnaire_dir_ggp_rsni';
    $fonction = 'rsni';

  break;

  case 'prob_non_informatique':
    // $role = 'gestionnaire_dir_ggp_agfm';
    $fonction = 'agfm';
    
  break;

  case 'prob_incident_pers_form':
    // $role = 'gestionnaire_incidents_reclamation_ggp';
    $fonction = 'do_da';
    $pole_concerne = $webform_submission->getElementData('pole_concerne');

    switch ($pole_concerne) {
      case 'pole_hrt':
        // $role = 'gestionnaire_dir_ggp_pole_hrt';
        $fonction = 'pole_hrt';
      break;
      case 'pole_fg':
        // $role = 'gestionnaire_dir_ggp_pole_fg';
        $fonction = 'pole_fg';
      break;
      case 'pole_ssap':
        // $role = 'gestionnaire_dir_ggp_pole_ssap';
        $fonction = 'pole_ssap';
      break;
      case 'pole_in':
        // $role = 'gestionnaire_dir_ggp_pole_in';
        $fonction = 'pole_in';
      break;
      case 'pole_btpl':
        // $role = 'gestionnaire_dir_ggp_pole_btp';
        $fonction = 'pole_btp';
      break;
    }

    
  break;

  case 'prob_incidents_pers_non_form':
    // $role = 'gestionnaire_incidents_reclamation_ggp';
    $fonction = 'do_da';
    
  break;

  default:
  $role = 'gestionnaire_incidents_reclamation_ggp';
  $fonction = 'do_da';
    break;
}

// if ($role) {
if ($fonction) {

  // dsm($fonction);
  $destinataires = get_users_email_with_fonction($role,$fonction);

  if (!empty($destinataires)) {
    $recipient = implode(", ", $destinataires);
  } else {
    //si personne avec ce role , on l'envoi au DO/DA
    $role = 'gestionnaire_incidents_reclamation_ggp';
  $fonction = 'do_da';
    $destinataires = get_users_email_with_fonction($role,$fonction);
    if (!empty($destinataires)) {
      $recipient = implode(", ", $destinataires);
    } else {
      //définir adresse par default
      $recipient = 'contact@koncept47.com';
    }
  }
  // dsm($destinataires);
  $message['to_mail'] = $recipient;
  
  parent::sendMessage($webform_submission, $message);
}





  }
}
