# Пример использования 

#### Пример 1: использование ограничений без параметров

```php
<?php
// /src/DTO
...

use PasswordEntropyBundle\Validator as EntropeAssert;

class Document
{
    /**
     * @EntropeAssert\NISTEntropy()
     * @EntropeAssert\OccurrenceEntropy()
     */
    public ?string $password;
}
```


#### Пример 2: установка уровня пароля для ограничения

```php
<?php
// /src/DTO
...

use PasswordEntropyBundle\Validator as EntropeAssert;

class Document
{
    /**
     * @EntropeAssert\NISTEntropy(level=2)
     * @EntropeAssert\OccurrenceEntropy(level=4)
     */
    public ?string $password;
}
```