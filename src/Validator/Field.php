<?php

namespace Validator;

/**
 * Class Field
 * @author  Lucas A. de Araújo <lucas@minervasistemas.com.br>
 * @package Validator
 */
class Field
{
    private $name;
    private $value;

    /**
     * Construtor
     * @param $name
     * @param $value
     */
    public function __construct($name, $value)
    {
        $this->setName($name);
        $this->setValue($value);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}