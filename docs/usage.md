# Пример использования 

#### Пример 1: использование ограничений без параметров

```php
<?php
// /src/DTO
...

use PasswordEntropyBundle\Validator as EntropyAssert;

class User
{
    /**
     * @EntropyAssert\NISTEntropy()
     * @EntropyAssert\OccurrenceEntropy()
     */
    public ?string $password;
}
```


#### Пример 2: установка уровня пароля для ограничения

```php
<?php
// /src/DTO
...

use PasswordEntropyBundle\Validator as EntropyAssert;

class User
{
    /**
     * @EntropyAssert\NISTEntropy(level=2)
     * @EntropyAssert\OccurrenceEntropy(level=4)
     */
    public ?string $password;
}
```