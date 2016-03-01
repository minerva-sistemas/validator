![](http://i.imgur.com/l1Fgbcd.png)

![](https://poser.pugx.org/minerva-sistemas/silk-orm/license) ![](https://scrutinizer-ci.com/g/minerva-sistemas/validator/badges/build.png?b=master) ![](https://scrutinizer-ci.com/g/minerva-sistemas/validator/badges/quality-score.png?b=master) ![](https://poser.pugx.org/minerva-sistemas/validator/downloads) ![](https://poser.pugx.org/minerva-sistemas/validator/v/stable)

O validator é uma biblioteca para validação de dados que possui uma estrutura consistente e flexível, que pode facilmente implementar novas estratégias para aderir a novos contextos de validação.

### Instalação
`composer require minerva-sistemas/silk-orm`

### Exemplo

```php
$validator = new Validator();

// Validação do campo nome do formulário.
$validator->getValidations()->add(function (Validation $v) {
   $v->setField(new Field('nome', 'NathanCambiriba'));
   $v->getRules()->add(new MaxLength(10));
});

$validator->getErrors()->count();
```
