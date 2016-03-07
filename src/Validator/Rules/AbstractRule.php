<?php

namespace Validator\Rules;

/**
 * Class AbstractRule
 * @author  Lucas A. de Araújo <lucas@minervasistemas.com.br>
 * @package Validator\Rules
 */
abstract class AbstractRule implements RuleInterface
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * Retorna o valor a ser validado.
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Define o dado a ser validado.
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

}