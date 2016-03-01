<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\Float;
use Validator\Validator;
use Validator\Validation;

/**
 * Classe para a validação dos testes na regra de Float.
 *
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package ValidatorTest
 */
class FloatTest
{
    /**
     * Testa a validação de Float
     */
    public function testFloatValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para formato de Float
        //Simulação com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('valor', 10.25));
            $v->getRules()->add(new Float());
        });

        // Regra de validação para formato de Float
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('valor', "10.25"));
            $v->getRules()->add(new Float());
        });

        // Regra de validação para formato de Float
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('valor', 10));
            $v->getRules()->add(new Float());
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }
}