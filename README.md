![](http://i.imgur.com/l1Fgbcd.png)

![](https://poser.pugx.org/minerva-sistemas/silk-orm/license) ![](https://scrutinizer-ci.com/g/minerva-sistemas/validator/badges/build.png?b=master) ![](https://scrutinizer-ci.com/g/minerva-sistemas/validator/badges/quality-score.png?b=master)

O validator é uma biblioteca para validação de dados que possui uma estrutura consistente e flexível, que pode facilmente implementar novas estratégias para aderir a novos contextos de validação.

### Exemplo
```php
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
```
