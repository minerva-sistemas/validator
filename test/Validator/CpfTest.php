<?php

namespace ValidatorTest;

use Validator\Validator;
use Validator\Validation;
use Validator\Field;
use Validator\Rules\Cpf;

/**
 * Class CpfTest
 * @author  Lucas A. de Araújo <lucas@painapp.com.br>
 * @package ValidatorTest
 */
class CpfTest extends \PHPUnit_Framework_TestCase
{
    public function testCpf()
    {
        //Instanciamento da classe validatora
        $validator = new Validator();

        //Regra de validaÃ§Ã£o do cpf simulando um erro
        $validator->getValidations()->add(function (Validation $v) {
            $v->setField(new Field('cpf', '056.659.658-12'));
            $v->getRules()->add(new Cpf());
        });

        //Regra de validaÃ§Ã£o do cpf sem simular o erro
        $validator->getValidations()->add(function (Validation $v) {
            $v->setField(new Field('cpf', '894.434.123-06'));
            $v->getRules()->add(new Cpf());
        });

        //Executar a validaÃ§Ã£o do cpf
        $validator->execute();

        //verifica se foi gerado um erro
        $this->assertEquals(1,$validator->getErrors()->count());
    }
}