# IcebergPHP
IcebergPHP - это современный фреймворк для веб-приложений. IcebergPHP выделяется на фоне других фреймворков своей компактностью, простотой установки, а так же тем, что сделан в России.
## Требования
- PHP >= 7
- Подключенные зависимости из [php.ini](ini/php.ini)
## Установка
1) Скачать или склонировать репозиторий в удобное место
2) Написать код
3) Запустить файл ```start.bat``` или ```start.sh```, зависимо от системы
4) Наслаждаться результатом
## Документация
- [PHPRouter](docs/PHPRouter.md)
- [PHPExceptionHandler](docs/PHPExceptionHandler.md)
- [PHPOrm](docs/PHPOrm.md)
- [PHPSystem](docs/PHPSystem.md)
- [PHPTemplater](docs/PHPTemplater.md)
- [PHPView](docs/PHPView.md)
- [PHPMailer](docs/PHPMailer.md)
- [PHPHash](docs/PHPHash.md)
- [PHPRequester](docs/PHPRequester.md)
## Структура
```
app/                  Системные библиотеки   
controllers/          Контроллеры
docs/                 Документация
models/               Модели
pages/                Страницы
routes/               Маршруты
ini/                  Файл php.ini
```
## Использование helper
**1. Создание контроллера**
Windows:
```sh
helper.exe create-controller TestController
```
Linux:
```sh
./helper create-controller TestController
```

**Описание:** Создает контроллер TestController в директории controllers. Если директория controllers отсутствует, то создает ее

<br>

**2. Создание модели**
Windows:
```sh
helper.exe create-model User
```
Linux:
```sh
./helper create-model User
```

**Описание:** Создает модель User в директории models. Если директория models отсутствует, то создает ее

Репозиторий helper - https://github.com/mrProger/Helper

## Участие в разработке
Здесь вы можете предложить свою идею для будущего обновления - [Предложить](https://github.com/mrProger/IcebergPHP/issues/1)