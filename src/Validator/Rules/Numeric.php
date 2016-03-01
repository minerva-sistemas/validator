<?php

namespace Validator\Rules;
use Validator\Exception\ValidationException;

/**
 * Class Numeric
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package Validator\Rules
 */
class Numeric implements RuleInterface
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
        if(!ctype_digit($this->getData())) {
            throw new ValidationException("Deve conter apenas números.");
        }
    }
}