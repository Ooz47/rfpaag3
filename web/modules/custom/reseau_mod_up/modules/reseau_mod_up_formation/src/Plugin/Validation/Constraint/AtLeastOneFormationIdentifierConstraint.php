<?php

namespace Drupal\reseau_mod_up_formation\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Vérifie qu'au moins un des champs d'identification de la formation est renseigné.
 *
 * @Constraint(
 *   id = "AtLeastOneFormationIdentifier",
 *   label = @Translation("At Least One Formation Identifier", context = "Validation"),
 *   type = "string"
 * )
 */
class AtLeastOneFormationIdentifierConstraint extends Constraint {

  // Message affiché si la contrainte n'est pas respectée.
  public $message = 'Au moins un champ d\'identification de la formation doit être renseigné. Veuillez préciser le Formacode ou le code RNCP ou le code diplôme';

}