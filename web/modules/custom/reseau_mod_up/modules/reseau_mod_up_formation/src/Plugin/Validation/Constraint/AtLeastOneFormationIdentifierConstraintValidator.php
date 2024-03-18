<?php

namespace Drupal\reseau_mod_up_formation\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the AtLeastOneFormationIdentifier constraint.
 */
class AtLeastOneFormationIdentifierConstraintValidator extends ConstraintValidator
{

  /**
   * {@inheritdoc}
   */
  public function validate($entity, Constraint $constraint)
  {
    if (in_array($entity->getType(), ['formation'])) {
      if (($entity->get('field_fmt_code_diplome')->isEmpty()) && ($entity->get('field_fmt_code_rncp')->isEmpty()) && ($entity->get('field_formacode')->isEmpty())) {
        $this->context->addViolation($constraint->message);
      }
    }
  }
}
