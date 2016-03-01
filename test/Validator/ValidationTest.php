<?php

namespace ValidatorTest;

use Collections\ArrayList;
use Validator\Field;

use Validator\Rules\Name;
use Validator\Rules\Boolean;
use Validator\Rules\BlackList;
use Validator\Rules\Cpf;
use Validator\Rules\DateFormat;
use Validator\Rules\Int;
use Validator\Rules\Email;
use Validator\Rules\Float;
use Validator\Rules\IP;
use Validator\Rules\NoNumber;
use Validator\Rules\Numeric;
use Validator\Rules\URL;
use Validator\Rules\MaxLength;
use Validator\Rules\MinLength;
use Validator\Rules\Sequence;
use Validator\Validator;
use Validator\Validation;

/**
 * Class ValidationTest
 * @author  Lucas A. de Araújo lucas@minervasistemas.com.br>
 */
class ValidationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a validação para o tamanho minimo de strings.
     */
    public function testMinLenghtValidation()
    {
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para nome
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('nome', 'Luca'));
            $v->getRules()->add(new MinLength(05));
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(1, $validator->getErrors()->count());

        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para nome
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('nome', 'Lucas'));
            $v->getRules()->add(new MinLength(05));
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(0, $validator->getErrors()->count());
    }


    /**
     * Testa a validação de Email.
     */
    public function testEmailValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para nome
        //Simulação com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('email', 'luanmaik1994@gmail.com'));
            $v->getRules()->add(new Email());
        });

        // Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('email', 'luanmaik1994gmail.com'));
            $v->getRules()->add(new Email());
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(1, $validator->getErrors()->count());

    }


    /**
     * Testa a validação para o tamanho máximo de strings.
     */
    public function testMaxLengthValidator()
    {
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para nome simulando um erro
        $validator->getValidations()->add(function (Validation $v) {
            $v->setField(new Field('nome', 'Nathan Cambiriba do Nascimento'));
            $v->getRules()->add(new MaxLength(10));
        });

        // Regra de validação para nome
        $validator->getValidations()->add(function (Validation $v) {
            $v->setField(new Field('nome', 'Nathan Cambiriba do Nascimento'));
            $v->getRules()->add(new MaxLength(10));
        });

        // Regra de validação para nome
        $validator->getValidations()->add(function (Validation $v) {
            $v->setField(new Field('nome', 'Nathan Cambiriba do Nascimento'));
            $v->getRules()->add(new MaxLength(100));
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2,$validator->getErrors()->count());
    }



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
    

    /**
     * Testa a validação de URL.
     */
    public function testURLValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para formato de URL
        //Simulação com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('caminho', 'http://localhost/meuprojeto/'));
            $v->getRules()->add(new URL());
        });

        // Regra de validação para formato de URL
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('caminho', 'htp~://localhost/meuprojeto/'));
            $v->getRules()->add(new URL());
        });

        // Regra de validação para formato de URL
        //Simulação com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('caminho', 'http:<>localhost/meuprojeto/'));
            $v->getRules()->add(new URL());
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }


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