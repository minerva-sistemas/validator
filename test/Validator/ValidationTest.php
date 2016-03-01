<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\Name;
use Validator\Rules\Boolean;
use Validator\Rules\DateFormat;
use Validator\Rules\Int;
use Validator\Rules\Email;
use Validator\Rules\Float;
use Validator\Rules\Ip;
use Validator\Rules\MinLength;
use Validator\Rules\Numeric;
use Validator\Rules\URL;
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


    /**
     * Testa a valida��o de Formato de Data.
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



    /**
     * Testa a valida��o de IP.
     */
    public function testIPValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para formato de IP
        //Simula��o com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ip', '255.254.189.133'));
            $v->getRules()->add(new IP());
        });

        // Regra de valida��o para formato de IP
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ip', '270.254.189.133'));
            $v->getRules()->add(new IP());
        });

        // Regra de valida��o para formato de IP
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ip', '200.284.189.133'));
            $v->getRules()->add(new IP());
        });

        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }



    /**
     * Testa a valida��o de URL.
     */
    public function testURLValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para formato de URL
        //Simula��o com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('caminho', 'http://localhost/meuprojeto/'));
            $v->getRules()->add(new URL());
        });

        // Regra de valida��o para formato de URL
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('caminho', 'htp~://localhost/meuprojeto/'));
            $v->getRules()->add(new URL());
        });

        // Regra de valida��o para formato de URL
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('caminho', 'http:<>localhost/meuprojeto/'));
            $v->getRules()->add(new URL());
        });

        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }


    /**
     * Testa a valida��o de Inteiro
     */
    public function testIntValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para formato de inteiro
        //Simula��o com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('numero', 23));
            $v->getRules()->add(new Int());
        });

        // Regra de valida��o para formato de inteiro
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('numero', '23'));
            $v->getRules()->add(new Int());
        });

        // Regra de valida��o para formato de inteiro
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('numero', '10'));
            $v->getRules()->add(new Int());
        });

        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }


    /**
     * Testa a valida��o de Boolean
     */
    public function testBooleanValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para formato de Boolean
        //Simula��o com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ativo', true));
            $v->getRules()->add(new Boolean());
        });

        // Regra de valida��o para formato de Boolean
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ativo', 'true'));
            $v->getRules()->add(new Boolean());
        });

        // Regra de valida��o para formato de Boolean
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('ativo', 'false'));
            $v->getRules()->add(new Boolean());
        });

        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }



    /**
     * Testa a valida��o de Float
     */
    public function testFloatValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para formato de Float
        //Simula��o com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('valor', 10.25));
            $v->getRules()->add(new Float());
        });

        // Regra de valida��o para formato de Float
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('valor', "10.25"));
            $v->getRules()->add(new Float());
        });

        // Regra de valida��o para formato de Float
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('valor', 10));
            $v->getRules()->add(new Float());
        });

        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }


    /**
     * Testa a valida��o de Numeric
     * A string s� pode conter n�meros
     */
    public function testNumericValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para formato de Numeric
        //Simula��o com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('idade', "21"));
            $v->getRules()->add(new Numeric());
        });

        // Regra de valida��o para formato de Numeric
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('idade', "21a"));
            $v->getRules()->add(new Float());
        });

        // Regra de valida��o para formato de Numeric
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('idade', "abc"));
            $v->getRules()->add(new Float());
        });

        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }


    /**
     * Testa a valida��o de Nome
     * A string n�o pode conter numeros
     */
    public function testNameValidation(){
        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de valida��o para formato de Nome
        //Simula��o com acerto
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('nome', "LuanMaik"));
            $v->getRules()->add(new Name());
        });

        // Regra de valida��o para formato de Nome
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('nome', "Lu4n Ma1k"));
            $v->getRules()->add(new Name());
        });

        // Regra de valida��o para formato de Nome
        //Simula��o com erro
        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('nome', "luan maik 21"));
            $v->getRules()->add(new Name());
        });

        // Executa a valida��o dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(2, $validator->getErrors()->count());

    }


}