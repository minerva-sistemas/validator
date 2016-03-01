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

     private function startValidations(){

         $data = $this->getData();

         $blackList = new ArrayList();
         $blackList->add('00000000000');
         $blackList->add('11111111111');
         $blackList->add('22222222222');
         $blackList->add('33333333333');
         $blackList->add('44444444444');
         $blackList->add('55555555555');
         $blackList->add('77777777777');
         $blackList->add('66666666666');
         $blackList->add('88888888888');
         $blackList->add('99999999999');

         $this->validator->getValidations()->add(function(Validation $v) use($data, $blackList) {
             $v->setField(new Field('cpf',$data));
             $v->getRules()->add(new MinLength('11'));
             $v->getRules()->add(new BlackList($blackList));
         });

         $this->validator->execute();

     }

     public function execute()
     {
         $this->startValidations();
         if($this->calculateNumbers() === false || $this->validator->getErrors()->count() > 0){
             throw new ValidationException("Cpf inválido");
         }
     }


 }