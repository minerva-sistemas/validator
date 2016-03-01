<?php

namespace Validator\Rules;
use Validator\Exception\ValidationException;

/**
 * Class Name
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package Validator\Rules
 */
class Name implements RuleInterface
{
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

    public function execute()
    {
        if(preg_match("/[0-9]/", $this->getData())) {
            throw new ValidationException("Deve conter apenas letras.");
        }
    }
}