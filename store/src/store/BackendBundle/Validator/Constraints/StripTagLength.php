<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 16/04/15
 * Time: 15:56
 */

namespace store\BackendBundle\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * la classe qui représente ma contrainte
 * Class StripTagLength
 * @package store\BackendBundle\Validator\Constraints
 */
class StripTagLength extends Constraint
{
    // Message qui apparait dans ma contrainte de validation
    public $message = 'Le texte est trop longue';
}