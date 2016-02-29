<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\DateFormat;
use Validator\Rules\Email;
use Validator\Rules\MaxLength;
use Validator\Rules\MinLength;
use Validator\Validator;
use Validator\Validation;

/**
 * Class ValidationTest
 * @author  Lucas A. de Ara�jo lucas@minervasistemas.com.br>
 */
class ValidationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a valida��o para o tamanho minimo de strings.
     */
    public function testMinLenghtValidation()
    {
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para nome
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('nome', 'Luca'));
            $v->getRules()->add(new MinLength(05));
        });

        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(1, $validator->getErrors()->count());

        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para nome
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('nome', 'Lucas'));
            $v->getRules()->add(new MinLength(05));
        });

        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(0, $validator->getErrors()->count());
    }


    /**
     * Testa a valida��o de Email.
     */
    public function testEmailValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para nome
        //Simula��o com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('email', 'luanmaik1994@gmail.com'));
            $v->getRules()->add(new Email());
        });

        // Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('email', 'luanmaik1994gmail.com'));
            $v->getRules()->add(new Email());
        });

        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(1, $validator->getErrors()->count());

    }

    public function testMaxLengthValidator()
    {
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para nome
        $validator->getValidations()->add(function (Validation $v) {
            $v->setField(new Field('nome', 'Nathan Cambiriba do Nascimento'));
            $v->getRules()->add(new MaxLength(10));
        });

        // Regra de valida��o para nome
        $validator->getValidations()->add(function (Validation $v) {
            $v->setField(new Field('nome', 'Nathan Cambiriba do Nascimento'));
            $v->getRules()->add(new MaxLength(10));
        });

        // Regra de valida��o para nome
        $validator->getValidations()->add(function (Validation $v) {
            $v->setField(new Field('nome', 'Nathan Cambiriba do Nascimento'));
            $v->getRules()->add(new MaxLength(100));
        });

        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2,$validator->getErrors()->count());
    }

    /**
     * Testa a valida��o de Data.
     */
    public function testDateValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para formato da data
        //Simula��o com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('data', '1994-08-23'));
            $v->getRules()->add(new DateFormat("Y-m-d"));
        });

        // Regra de valida��o para formato da data
        //Simula��o com erro-1
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('data', '199-08-23'));
            $v->getRules()->add(new DateFormat("Y-m-d"));
        });

        // Regra de valida��o para formato da data
        //Simula��o com erro-2
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('data', '1994-23-23'));
            $v->getRules()->add(new DateFormat("Y-m-d"));
        });



        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }

}