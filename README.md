# Сайт русскоязычного сообщества Laravel

Новая версия сайта [https://laravel.su](https://laravel.su). 

## Установка

1. Скачайте и установите Docker и Docker Compose.
2. Откройте консоль и выполните `docker-compose up --build`
> Это запустит рабочее приложение сайта. Для завершения работы - просто закройте консоль.
3. Откройте новую сессию терминала и выполните `docker exec -it laravelsu-php /bin/bash` 
> Это позволит войти внутрь контейнера
4. Выполните:
```
$ composer install
$ cp .env.example .env
$ php artisan key:generate
```
5. Откройте в браузере `http://localhost:7001/`

Пунткы 3 и 4 требуются только при первом запуске. В дальнейшем они понядобятся только при обновлениях.

### 

### Системные требования для локальной установки.

- PHP 7.4 или выше
- MySql 5.7 или выше
- Веб-сервер (Apache, Nginx, Roadrunner, etc.)

### Перевод документации

[Инструкция, как это делать правильно](http://laravel.su/articles/rus-documentation-contribution-guide).
