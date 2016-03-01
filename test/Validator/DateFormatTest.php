<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\DateFormat;
use Validator\Validator;
use Validator\Validation;

/**
 * Classe para a validação dos testes na regra de DateFormat.
 *
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package ValidatorTest
 */
class DateFormatTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a validação de Formato de Data.
     */
    public function testDateFormatValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para formato da data
        //Simulação com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('data', '1994-08-23'));
            $v->getRules()->add(new DateFormat("Y-m-d"));
        });

        // Regra de validação para formato da data
        //Simulação com erro-1
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('data', '199-08-23'));
            $v->getRules()->add(new DateFormat("Y-m-d"));
        });

        // Regra de validação para formato da data
        //Simulação com erro-2
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('data', '1994-23-23'));
            $v->getRules()->add(new DateFormat("Y-m-d"));
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }
}