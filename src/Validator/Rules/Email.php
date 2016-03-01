<?php

namespace Validator\Rules;

use Validator\Exception\ValidationException;

/**
 * Class Email
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package Validator\Rules
 */
class Email implements RuleInterface
{
    /**
     * @var mixed
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
        if(filter_var($this->getData(), FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException("O formato do email é inválido.");
        }
    }
}