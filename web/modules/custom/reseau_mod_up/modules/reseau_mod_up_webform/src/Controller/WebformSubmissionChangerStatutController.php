<?php

namespace Drupal\reseau_mod_up_webform\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\webform\Entity\WebformSubmission;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WebformSubmissionApproveController.
 *
 * @package Drupal\reseau_mod_up_webform\Controller
 */
class WebformSubmissionChangerStatutController extends ControllerBase
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
  public function marquerTraiteFormation(WebformSubmission $submission, Request $request)
  {

    $timezone = new \DateTimeZone('America/Guadeloupe');
    $now = DrupalDateTime::createFromTimestamp(time(), $timezone);

    $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
    $submission->setElementData('statut', 'Traité-formation');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Traité: Entré.e en formation.', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }

  public function marquerTraiteAttente(WebformSubmission $submission, Request $request)
  {

    $timezone = new \DateTimeZone('America/Guadeloupe');
    $now = DrupalDateTime::createFromTimestamp(time(), $timezone);

    $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
    $submission->setElementData('statut', 'Traité-attente');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Traité: En attente d’intégrer une formation.', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }

  public function marquerTraiteOriente(WebformSubmission $submission, Request $request)
  {

    $timezone = new \DateTimeZone('America/Guadeloupe');
    $now = DrupalDateTime::createFromTimestamp(time(), $timezone);

    $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
    $submission->setElementData('statut', 'Traité-orienté');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Traité: Orienté.e vers une autre structure.', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }

  public function marquerTraite(WebformSubmission $submission, Request $request)
  {

    $timezone = new \DateTimeZone('America/Guadeloupe');
    $now = DrupalDateTime::createFromTimestamp(time(), $timezone);

    $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
    $submission->setElementData('statut', 'Traité');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Traité', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }

  public function marquerTraiteAutreDemande(WebformSubmission $submission, Request $request)
  {

    $timezone = new \DateTimeZone('America/Guadeloupe');
    $now = DrupalDateTime::createFromTimestamp(time(), $timezone);

    $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
    $submission->setElementData('statut', 'Traité-autre');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Traité : Autre demande', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }

  public function marquerTraiteConvocationInfocoll(WebformSubmission $submission, Request $request)
  {

    $timezone = new \DateTimeZone('America/Guadeloupe');
    $now = DrupalDateTime::createFromTimestamp(time(), $timezone);

    $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
    $submission->setElementData('statut', 'Traité-convocation-infocoll');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Traité : Convocation à une infocoll', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }
  public function marquerTraiteEntretien(WebformSubmission $submission, Request $request)
  {

    $timezone = new \DateTimeZone('America/Guadeloupe');
    $now = DrupalDateTime::createFromTimestamp(time(), $timezone);

    $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
    $submission->setElementData('statut', 'Traité-entretien');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Traité : Entretien', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }

  public function marquerTraiteSelectionReglementaire(WebformSubmission $submission, Request $request)
  {

    $timezone = new \DateTimeZone('America/Guadeloupe');
    $now = DrupalDateTime::createFromTimestamp(time(), $timezone);

    $submission->setElementData('traite_le', $now->format('Y-m-d\TH:i:00P'));
    $submission->setElementData('statut', 'Traité-sélection-règlementaire');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: Traité : Sélection réglementaire', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }

  public function marquerEncoursTransmisEntretien(WebformSubmission $submission, Request $request)
  {

    $submission->setElementData('traite_le', '');
    $submission->setElementData('statut', 'Encours-entretien');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: En cours : Transmis pour entretien .', [
      '@serial' => $submission->serial(),
    ]));

    return $request->query->get('destination') ? new RedirectResponse($request->query->get('destination')) : [];
  }

  public function marquerEncoursTransmisInfocol(WebformSubmission $submission, Request $request)
  {

    $submission->setElementData('traite_le', '');
    $submission->setElementData('statut', 'Encours-inscription-infocol');
    $submission->save();

    $this->messenger()->addMessage($this->t('Statut demande @serial modifié: En cours : Inscription en infocol.', [
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
    return AccessResult::allowedIf(!$submission->isDraft() && array_intersect(array('administrator', 'webmaster_cfapag', 'gestionnaire_formulaire_greta_guadeloupe','webmaster_greta_sxmsbh', 'webmaster_reseau'), $this->currentUser()->getRoles()) !== []);
  }
}
