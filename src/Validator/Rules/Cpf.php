<?php

namespace Validator\Rules;

use Collections\ArrayList;
use Validator\Exception\ValidationException;
use Validator\Field;
use Validator\Validation;
use Validator\Validator;

 /**
 * Class MinLength
 * @author  Nathan C.N <nathan@domusinfo.com.br>
 * @package Validator\Rules
 */
 class Cpf implements RuleInterface
 {
     /**
      * Dado a ser validado
      * @var string
      */
     private $data;

     /**
      * @var Validator
      */
     private $validator;

     /**
      * Cpf constructor.
      */
     public function __construct()
     {
        $this->validator = new Validator();
     }

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
         $this->data = preg_replace('/[^0-9]/', '', (string) $data);
     }

     /**
      * Faz o cálculo responsável por definir se o digito
      * verificador corresponde com o corpo do CPF.
      * @return bool
      */
     private function calculateNumbers()
     {
         for ($total_caracteres = 9; $total_caracteres < 11; $total_caracteres++)
         {
             for ($digito = 0, $count = 0; $count < $total_caracteres; $count++)
             {
                 $digito += $this->data{$count} * (($total_caracteres + 1) - $count);
             }

             $digito = ((10 * $digito) % 11) % 10;

             if ($this->data{$count} != $digito) {
                 return false;
             }
         }

         return true;
     }

     /**
      * Verifica se o CPF é alguma das sequencias não permitidas
      * ou se ele tem o tamanho minimo de 11 caracteres.
      * @return void
      */
     private function startValidations()
     {
         $data = $this->getData();

         $blackList = new ArrayList();
         $blackList->addAll([
             '00000000000', '11111111111', '22222222222', '33333333333', '44444444444',
             '55555555555', '66666666666', '77777777777', '88888888888', '99999999999'
         ]);

         $this->validator->getValidations()->add(function(Validation $v) use($data, $blackList) {
             $v->setField(new Field('cpf',$data));
             $v->getRules()->add(new MinLength('11'));
             $v->getRules()->add(new BlackList($blackList));
         });

         $this->validator->execute();
     }

     /**
      * Executa as validações.
      * @throws ValidationException
      */
     public function execute()
     {
         $this->startValidations();
         if($this->calculateNumbers() === false || $this->validator->getErrors()->count() > 0){
             throw new ValidationException("Cpf inválido");
         }
     }


 }