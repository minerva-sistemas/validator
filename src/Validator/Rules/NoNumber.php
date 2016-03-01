<?php

namespace Validator\Rules;

use Validator\Exception\ValidationException;

/**
 * Class NoNumber
 * Classe que verifica se a String passada contém números, caso houver, é gerado um Exception
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package Validator\Rules
 */
class NoNumber implements RuleInterface
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
        if(preg_match("/[0-9]/", $this->getData())) {
            throw new ValidationException("Deve conter apenas letras.");
        }
    }
}