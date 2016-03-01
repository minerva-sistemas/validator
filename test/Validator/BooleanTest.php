<?php

namespace ValidatorTest;

use Validator\Validator;
use Validator\Validation;
use Validator\Field;
use Validator\Rules\Boolean;

/**
 * Class BooleanTest
 * @author  Lucas A. de Araújo <lucas@painapp.com.br>
 * @package ValidatorTest
 */
class BooleanTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a validação de Boolean
     */
    public function testBooleanValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para formato de Boolean
        //Simulação com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ativo', true));
            $v->getRules()->add(new Boolean());
        });

        // Regra de validção para formato de Boolean
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ativo', 'true'));
            $v->getRules()->add(new Boolean());
        });

        // Regra de validação para formato de Boolean
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ativo', 'false'));
            $v->getRules()->add(new Boolean());
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }
}