# Password entropy symfony bundle

![docs](https://img.shields.io/badge/docs-yes-blue)  ![license](https://img.shields.io/badge/license-MIT-brightgreen) ![useful](https://img.shields.io/badge/Maintained%3F-yes-brightgreen)

Небольшой бандл для расчета энтропии пароля на основе двух методов:
- расчет битового порога сложности (NIST);
- расчет вхождений символов в пароле.

В целом этот бандл это просто реализация ограничения валидации, основанного на общих рекомендациях определения сложности пароля.

### Установка 

```shell
composer require tcloud.ax/password-entropy-bundle
```

### Примеры

[Пример использования](https://gitlab.com/tcloud.ax/password_entropy_bundle/-/blob/master/docs/usage.md)


### Уровни паролей

1 - очень слабый пароль
2 - слабый пароль
3 - средний пароль
4 - сильный пароль
5 - очень сильный пароль

### Уровень по NIST


1 уровень - `bits` < 16

2 уровень - `bits` < 17-27

3 уровень - `bits` < 28-44

4 уровень - `bits` < 45-80

5 уровень - `bits` > 80,


где `bits` - битовый порог сложности пароля.


### Уровень по вхождении символа


1 уровень - `occurrence` > 80%

2 уровень - `occurrence` > 50-79%

3 уровень - `occurrence` > 35-49%

4 уровень - `occurrence` > 10-34%

5 уровень - `occurrence` < 9%,


где `occurrence` - процент количества вхождений символа в пароле от его длины.