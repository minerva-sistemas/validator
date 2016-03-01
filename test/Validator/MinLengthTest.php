<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\MinLength;
use Validator\Validator;
use Validator\Validation;

/**
 * Classe para a validação dos testes na regra de tamanho minimo de strings.
 *
 * @author  Luan Maik Cordeiro <luanmaik1994@gmail.com>
 * @package ValidatorTest
 */
class MinLengthTest extends \PHPUnit_Framework_TestCase
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
}