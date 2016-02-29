<?php

namespace Validator\Rules;

/**
 * Interface RuleInterface
 * @author  Lucas A. de Araújo <lucas@minervasistemas.com.br>
 * @package Validator\Rules
 */
interface RuleInterface
{
    public function setData($data);
    public function execute();
}