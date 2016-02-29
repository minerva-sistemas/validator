![](http://i.imgur.com/l1Fgbcd.png)

O validator é uma biblioteca para validação de dados que possui uma estrutura consistente e flexível, que pode facilmente implementar novas estratégias para aderir a novos contextos de validação.

### Exemplo
```php
$validator = new Validator();

// Regras para validação de nome
$validator->getValidations()->add(function(Validation $v) use($name) {
  $v->setData(new Field('nome', $nome));
  $v->getRules()->add(new MaxLengthRule(50));
  $v->getRules()->add(new MinLengthRule(03));
});

// E-mail da pessoa
$validator->getValidations()->add(function(Validation $v) use ($email){
  $v->getRules()->add(new EmailRule());
});

// Executa a valudação
$validator->execute();

// Exibe os erros encontrados
if($validator->getErrors()->count() > 0){
  $validator->getErrors()->map(function(ValidationError $error){
    echo $error->getData()->getName();
    echo $error->getData()->getValue();
    echo $error->getMessage();
  });
```
