<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\Cnpj;
use Validator\Validation;
use Validator\Validator;

/**
 * Class CnpjTest
 * @author  Lucas A. de Araújo <lucas@minervasistemas.com.br>
 * @package ValidatorTest
 */
class CnpjTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Insere um número de CNPJ válido e verifica se o validador
     * irá o interpretar como tal.
     */
    public function testValidCnpj()
    {
        $validator = new Validator();

        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('cnpj', '15.234.350/0001-90'));
            $v->getRules()->add(new Cnpj());
        });

        $validator->execute();

        $this->assertEquals($validator->getErrors()->count(), 0);
    }

    /**
     * Insere um número de CNPJ inválido e verifica se o validador
     * irá o interpretar como tal.
     */
    public function testInvalidCnpj()
    {
        $validator = new Validator();

        $validator->getValidations()->add(function(Validation $v){
            $v->setField(new Field('cnpj', '15.234.350/0001-99'));
            $v->getRules()->add(new Cnpj());
        });

        $validator->execute();

        $this->assertEquals($validator->getErrors()->count(), 1);
    }
}