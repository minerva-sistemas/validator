<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\NoNumber;
use Validator\Validator;
use Validator\Validation;

/**
 * Classe para a validação dos testes na regra de NoNumber.
 *
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package ValidatorTest
 */
class NoNumberTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a validação de NoNumber
     * A string não pode conter numeros
     */
    public function testNoNumberValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para formato de Nome
        //Simulação com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('nome', "LuanMaik"));
            $v->getRules()->add(new NoNumber());
        });

        // Regra de validação para formato de Nome
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('nome', "Lu4n Ma1k"));
            $v->getRules()->add(new NoNumber());
        });

        // Regra de validação para formato de Nome
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('nome', "luan maik 21"));
            $v->getRules()->add(new NoNumber());
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());
    }
}