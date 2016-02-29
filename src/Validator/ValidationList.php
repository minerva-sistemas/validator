<?php

namespace Validator;

use Collections\ArrayList;

/**
 * Class ValidationList
 * @author  Lucas A. de Ara�jo lucas@minervasistemas.com.br>
 * @package Validator
 */
class ValidationList extends ArrayList
{
    /**
     * Adiciona uma valida��o.
     * @param mixed $item
     * @return $this|\Collections\VectorInterface|void
     */
    public function add($item)
    {
        if(is_callable($item)){
            $validation = new Validation();
            $item($validation);
            parent::add($validation);
        }
    }
}