<?php

namespace Validator\Rules;
use Validator\Exception\ValidationException;

/**
 * Class Boolean
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package Validator\Rules
 */
class Boolean implements RuleInterface
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
        if(!is_bool($this->getData())) {
            throw new ValidationException("O número informado não é do tipo boleano.");
        }
    }
}