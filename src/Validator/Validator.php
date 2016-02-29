<?php

namespace Validator;
use Collections\ArrayList;
use Validator\Exception\ValidationException;
use Validator\Rules\RuleInterface;

/**
 * Class Validator
 * @author  Lucas A. de Araújo <lucas@minervasistemas.com.br>
 * @package Validator
 */
class Validator
{
    /**
     * @var ValidationList
     */
    private $validations;

    /**
     * @var ArrayList
     */
    private $errors;

    /**
     * Construtor da biblioteca de validação.
     */
    public function __construct()
    {
        $this->validations = new ValidationList();
        $this->errors = new ArrayList();
    }

    /**
     * Retorna a lista de validações.
     * @return ValidationList
     */
    public function getValidations()
    {
        return $this->validations;
    }

    /**
     * Retorna a lista de erros gerados.
     * @return ArrayList
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $errors = &$this->errors;

        $this->getValidations()->map(function(Validation $v) use($errors) {
            $v->getRules()->map(function(RuleInterface $rule) use($v, $errors) {
                try
                {
                    $rule->setData($v->getField()->getValue());
                    $rule->execute();
                }
                catch(ValidationException $error)
                {
                    $error->setField($v->getField());
                    $errors->add($error);
                }
            });
        });
    }
}