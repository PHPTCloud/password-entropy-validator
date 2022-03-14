# Password entropy symfony bundle

![docs](https://img.shields.io/badge/docs-yes-blue)  ![license](https://img.shields.io/badge/license-MIT-brightgreen) ![useful](https://img.shields.io/badge/Maintained%3F-yes-brightgreen)

Небольшой бандл для расчета энтропии пароля на основе двух методов:
- расчет битового порога сложности (NIST);
- подсчет вхождений символов/слов в пароле.

В целом этот бандл это просто реализация ограничения валидации, основанного на общих рекомендациях определения сложности пароля.

### Установка 

```shell
composer require tcloud.ax/password-entropy-bundle
```