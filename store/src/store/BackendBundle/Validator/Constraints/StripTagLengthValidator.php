<?php

namespace store\BackendBundle\Validator\Constraints;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class StripTagLengthValidator extends ConstraintValidator
{
    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($value, Constraint $constraint)
    {
        //si ma longueur de ma chaine avec suppression des tags html est>500 caractères
      if(10 < strlen(strip_tags($value)))
      {
          //ajouter une violation au niveau des erreurs de mon formulaire
          $this->context->addViolation(
              $constraint->message, array('%string%' => $value));
      }
    }
}
