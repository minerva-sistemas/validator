<?php

namespace ValidatorTest;

use Collections\ArrayList;
use Validator\Field;
use Validator\Validator;
use Validator\Validation;
use Validator\Rules\WhiteList;

/**
 * Class WhiteListRuleTest
 * @author  Lucas A. de Ara�jo <lucas@minervasistemas.com.br>
 * @package ValidatorTest
 */
class WhiteListRuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a valida��o de um valor por lista branca.
     */
    public function testValidation()
    {
        // Lista de nomes permitidos
        $allowedNames = new ArrayList();
        $allowedNames->add('Lucas Andrade de Ara�jo');
        $allowedNames->add('Matheus Andrade de Ara�jo');

        $validator = new Validator();

        // Valida o nome "Lucas Andrade de Ara�jo" na lista branca.
        $validator->getValidations()->add(function(Validation $v) use($allowedNames) {
            $v->setField(new Field('nome', 'Lucas Andrade de Ara�jo'));
            $v->getRules()->add(new WhiteList($allowedNames));
        });

        // Valida o nome "Milena Nascimento Cabreira" na lista branca.
        $validator->getValidations()->add(function(Validation $v) use($allowedNames) {
            $v->setField(new Field('nome', 'Milena Nascimento Cabreira'));
            $v->getRules()->add(new WhiteList($allowedNames));
        });

        // Executa a valida��o das regras
        $validator->execute();

        // Verifica se o nome invalido � o nome que n�o est�
        // presente na lista de nomes permitidos.
        $invalidName = $validator->getErrors()->first()->getField()->getValue();
        $this->assertEquals('Milena Nascimento Cabreira', $invalidName);
    }
}