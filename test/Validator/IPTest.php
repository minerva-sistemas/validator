<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\IP;
use Validator\Validator;
use Validator\Validation;

/**
 * Classe para a validação dos testes na regra de IP.
 *
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package ValidatorTest
 */
class IPTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a validação de IP.
     */
    public function testIPValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para formato de IP
        //Simulação com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ip', '255.254.189.133'));
            $v->getRules()->add(new IP());
        });

        // Regra de validação para formato de IP
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ip', '270.254.189.133'));
            $v->getRules()->add(new IP());
        });

        // Regra de validação para formato de IP
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ip', '200.284.189.133'));
            $v->getRules()->add(new IP());
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }
}