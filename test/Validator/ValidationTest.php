<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\MinLenght;
use Validator\Rules\MinLength;
use Validator\Validator;
use Validator\Validation;

/**
 * Class ValidationTest
 * @author  Lucas A. de Araújo lucas@minervasistemas.com.br>
 */
class ValidationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a validação padrão de dados.
     */
    public function testValidation()
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
    }
}