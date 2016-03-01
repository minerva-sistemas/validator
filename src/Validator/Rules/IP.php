<?php

namespace Validator\Rules;
use Validator\Exception\ValidationException;

/**
 * Class Ip
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package Validator\Rules
 */
class IP implements RuleInterface
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
        if(!filter_var($this->getData(), FILTER_VALIDATE_IP)) {
            throw new ValidationException("O formato do IP é inválido.");
        }
    }
}