<?php

namespace ValidatorTest;

use Collections\ArrayList;
use Validator\Field;
use Validator\Rules\BlackList;
use Validator\Validator;
use Validator\Validation;

/**
 * Classe para a validação dos testes na regra de blacklist.
 *
 * @author  Lucas A. de Araújo <lucas@painapp.com.br>
 * @package ValidatorTest
 */
class BlackListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a validação pela regra blacklist.
     */
    public function testBlackList()
    {
        $blackList = new ArrayList();
        $blackList->addAll(['Lucas', 'Matheus']);

        $validator = new Validator();

        // Verifica se o nome 'Lucas' está permitido.
        $validator->getValidations()->add(function(Validation $v) use ($blackList) {
            $v->setField(new Field('nome', 'Lucas'));
            $v->getRules()->add(new BlackList($blackList));
        });

        // Verifica se o nome 'Adolf' está permitido.
        $validator->getValidations()->add(function(Validation $v) use ($blackList) {
            $v->setField(new Field('nome', 'Adolf'));
            $v->getRules()->add(new BlackList($blackList));
        });

        $validator->execute();
        $nomeNaoPermitido = $validator->getErrors()->first()->getField()->getValue();

        $this->assertEquals($nomeNaoPermitido, 'Lucas');
        $this->assertEquals($validator->getErrors()->count(), 1);
    }
}