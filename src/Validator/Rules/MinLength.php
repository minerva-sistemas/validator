<?php

namespace Validator\Rules;
use Validator\Exception\ValidationException;

/**
 * Class MinLength
 * @author  Lucas A. de Ara�jo <lucas@painapp.com.br>
 * @package Validator\Rules
 */
class MinLength implements RuleInterface
{
    private $minLength;
    private $data;

    /**
     * Construtor da regra de valida��o.
     * @param $minLength
     */
    public function __construct($minLength)
    {
        $this->setMinLength($minLength);
    }

    /**
     * @return mixed
     */
    public function getMinLength()
    {
        return $this->minLength;
    }

    /**
     * @param mixed $minLength
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    public function execute()
    {
        if(strlen($this->getData()) < $this->getMinLength()) {
            throw new ValidationException("O tamanho m�nimo permitido � de {$this->minLength} caracteres.");
        }
    }
}