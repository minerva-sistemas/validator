<?php

namespace ValidatorTest;

use Validator\Field;
use Validator\Rules\MimeTypes;
use Validator\Validator;
use Validator\Validation;

/**
 * Classe para a validação dos testes na regra de MimeTypes
 * @author  Nathan C. do Nascimento <nathan@mivervasistemas.com.br>
 * @package ValidatorTest
 */
class MimeTypesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Testa a validação para o tipo de MimeType
     */
    public function testMimeType()
    {
        // array de simulão da variavel $_FILE
        $arrayValorImagem =
            [
                'name' => 'base.jpg',
                'type' => 'jpg',
                'tmp_name' => __DIR__ . '../img/base.jpg',
                'error' => 0
            ];

        // Instanciamento da classe validadora
        $validator = new Validator();

        // Regra de validação para o mimeType
        $validator->getValidations()->add(function (Validation $v) use ($arrayValorImagem) {
            $v->setField(new Field('imagem', $arrayValorImagem));
            $v->getRules()->add(new MimeTypes(['image/jpg','image/jpeg', 'image/png']));
        });

        // Regra de validação para o mimeType simulano um erro
        $validator->getValidations()->add(function (Validation $v) use ($arrayValorImagem){
            $v->setField(new Field('imagem', $arrayValorImagem));
            $v->getRules()->add(new MimeTypes(['audio/x-mpeg-3', 'audio/x-mpeg']));
        });

        // Executa a validação dos dados
        $validator->execute();

        // Verifica se foi gerado um erro
        $this->assertEquals(1, $validator->getErrors()->count());
    }

}