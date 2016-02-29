<?php

namespace Validator\Rules;
use Validator\Exception\ValidationException;

/**
 * Class MinLength
 * @author  Nathan C.N <nathan@domusinfo.com.br>
 * @package Validator\Rules
 */

class MaxLength implements RuleInterface
{

    /**
     * String a ser validada.
     * @var string
     */
    private $data;

    /**
     * Tamanho máximo permitido.
     * @var int
     */
    private $maxLength;

    /**
     * Construtor da regra de validação.
     * @param $maxLength
     */
    function __construct($maxLength)
    {
        $this->setMaxLength($maxLength);
    }

    /**
     * @return mixed
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /**
     * @param mixed $maxLength
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
    }

    /**
     * @return mixed
     */
    public function getData(){
        return $this->data;
    }

    /**
     * @param $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Executa a validação.
     * @throws ValidationException
     */
    public function execute()
    {
        if(strlen($this->data) > $this->maxLength){
            throw new ValidationException("O tamanho máximo permitido é de {$this->getMaxLength()} caracteres.");
        }
    }
}
