<?php

namespace Validator\Rules;

use Validator\Exception\ValidationException;

/**
 * Class Int
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package Validator\Rules
 */
class Int implements RuleInterface
{
    /**
     * @var Dados a serem validados
     */
    private $data;

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

    /**
     * Executa a regra de validação.
     * @throws ValidationException
     */
    public function execute()
    {
        if(!is_int($this->getData())) {
            throw new ValidationException("O número informado não é do tipo inteiro.");
        }
    }
}