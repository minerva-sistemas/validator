<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\URL;
use Validator\Validator;
use Validator\Validation;

/**
 * Classe para a validação dos testes na regra de URL.
 *
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package ValidatorTest
 */
class URLTest extends \PHPUnit_Framework_TestCase
{
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
}