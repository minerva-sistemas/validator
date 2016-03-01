<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\Numeric;
use Validator\Validator;
use Validator\Validation;

/**
 * Classe para a validação dos testes na regra de numeric.
 *
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package ValidatorTest
 */
class NumericTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a validação de Numeric
     * A string só pode conter números
     */
    public function testNumericValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para formato de Numeric
        //Simulação com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('idade', "21"));
            $v->getRules()->add(new Numeric());
        });

        // Regra de validação para formato de Numeric
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('idade', "21a"));
            $v->getRules()->add(new Numeric());
        });

        // Regra de validação para formato de Numeric
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('idade', "abc"));
            $v->getRules()->add(new Numeric());
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }
}