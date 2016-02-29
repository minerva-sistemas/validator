<?php

namespace Validator\Exception;
use Validator\Field;

/**
 * Class ValidationException
 * @author  Lucas A. de Araújo <lucas@minervasistemas.com.br>
 * @package Validator\Exception
 */
class ValidationException extends \Exception
{
    /**
     * @var Field
     */
    private $field;

    /**
     * @return Field
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param Field $field
     */
    public function setField(Field $field)
    {
        $this->field = $field;
    }
}