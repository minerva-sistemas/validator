<?php

namespace Validator\Rules;

use Validator\Exception\ValidationException;

/**
 * Class URL
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package Validator\Rules
 */
class URL implements RuleInterface
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
        if(!filter_var($this->getData(), FILTER_VALIDATE_URL)) {
            throw new ValidationException("A URL informada não é valida.");
        }
    }
}