## Requisitos

* PHP 8.2 ou superior
* Composer
* Node.js 22 ou superior

## Sequência para criar o projeto

Criar o projeto com laravel

```composer create-project laravel/laravel .```

Iniciar o projeto com laravel

```PHP artisan serve```

Entrar no .env e ajustar o database:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= nome do banco
DB_USERNAME= usuario
DB_PASSWORD= senha

No terminal crie o model Filme e a migration:

```php artisan make:model Filme -m```

Depois rode a migration no terminal:

```php artisan migrate```

Crie o Controller:

```php artisan make:controller FilmeController```

Para que as imagens fiquem disponíveis e as armazenar:
Rode:

```php artisan storage:link```


