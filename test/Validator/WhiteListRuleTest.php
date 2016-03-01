<?php

namespace ValidatorTest;

use Collections\ArrayList;
use Validator\Field;
use Validator\Validator;
use Validator\Validation;
use Validator\Rules\WhiteList;

/**
 * Class WhiteListRuleTest
 * @author  Lucas A. de Araújo <lucas@minervasistemas.com.br>
 * @package ValidatorTest
 */
class WhiteListRuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a validação de um valor por lista branca.
     */
    public function testValidation()
    {
        // Lista de nomes permitidos
        $allowedNames = new ArrayList();
        $allowedNames->add('Lucas Andrade de Araújo');
        $allowedNames->add('Matheus Andrade de Araújo');

        $validator = new Validator();

        // Valida o nome "Lucas Andrade de Araújo" na lista branca.
        $validator->getValidations()->add(function(Validation $v) use($allowedNames) {
            $v->setField(new Field('nome', 'Lucas Andrade de Araújo'));
            $v->getRules()->add(new WhiteList($allowedNames));
        });

        // Valida o nome "Milena Nascimento Cabreira" na lista branca.
        $validator->getValidations()->add(function(Validation $v) use($allowedNames) {
            $v->setField(new Field('nome', 'Milena Nascimento Cabreira'));
            $v->getRules()->add(new WhiteList($allowedNames));
        });

        // Executa a validação das regras
        $validator->execute();

        // Verifica se o nome invalido é o nome que não está
        // presente na lista de nomes permitidos.
        $invalidName = $validator->getErrors()->first()->getField()->getValue();
        $this->assertEquals('Milena Nascimento Cabreira', $invalidName);
    }
}