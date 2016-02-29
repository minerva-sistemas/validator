<?php

namespace Validator;

use Collections\ArrayList;

/**
 * Class Validation
 * @author  Lucas A. de Araújo <lucas@minervasistemas.com.br>
 * @package Validator
 */
class Validation
{
    /**
     * @var Field
     */
    private $field;

    /**
     * @var ArrayList
     */
    private $rules;

    public function __construct()
    {
        $this->setRules(new ArrayList());
    }

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
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     * @return ArrayList
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param ArrayList $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

}