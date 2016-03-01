<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\MaxLength;
use Validator\Validator;
use Validator\Validation;

/**
 * Classe para a validação dos testes na regra de tamanho máximo de strings.
 *
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package ValidatorTest
 */
class MaxLengthTest extends \PHPUnit_Framework_TestCase
{
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

}