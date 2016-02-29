<?php

namespace Validator\Rules;

interface RuleInterface
{
    public function setData($data);
    public function execute();
}