<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\Int;
use Validator\Validator;
use Validator\Validation;

/**
 * Classe para a validação dos testes na regra de integer.
 *
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package ValidatorTest
 */
class IntTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a validação de Inteiro
     */
    public function testIntValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para formato de inteiro
        //Simulação com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('numero', 23));
            $v->getRules()->add(new Int());
        });

        // Regra de validação para formato de inteiro
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('numero', '23'));
            $v->getRules()->add(new Int());
        });

        // Regra de validação para formato de inteiro
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('numero', '10'));
            $v->getRules()->add(new Int());
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }
}