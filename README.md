![](http://i.imgur.com/l1Fgbcd.png)

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
