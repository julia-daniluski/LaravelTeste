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


## SITE

O site criado com ajuda do laravel, usando html, php, javascript, mysql e css, a ideia era criar um CRUD onde as pessoas pudessem adicionar os filmes que já assistiram.

### 1 - na primeira imagem é possível ver o formulário de cadastro dos filmes
<img width="1889" height="871" alt="Captura de tela 2025-08-25 082112" src="https://github.com/user-attachments/assets/dfff3aac-bdae-4318-a5e8-3acdc68fc822" />

### 2 - na segunda foto temos a maneira como devem ser colocadas as informações para adicionar os filmes

<img width="1919" height="875" alt="Captura de tela 2025-08-25 082227" src="https://github.com/user-attachments/assets/d94f43d3-7e11-49c8-a4ea-b4459bab2938" />

### 3 - na terceira foto é o aviso que aparece quando você tem o cadastro concluido com sucesso

<img width="1893" height="872" alt="Captura de tela 2025-08-25 082244" src="https://github.com/user-attachments/assets/6e45f2d1-8f7c-4620-b4b1-68c634296033" />

### 4 - aqui temos como ficou com o filme cadastrado

<img width="1919" height="877" alt="Captura de tela 2025-08-25 082314" src="https://github.com/user-attachments/assets/0319b0f6-617f-443f-9565-77ecedef4ce5" />

### 5 - aqui o formulário para edição 

<img width="1919" height="869" alt="Captura de tela 2025-08-25 082323" src="https://github.com/user-attachments/assets/a5d1e0fb-4d3e-4971-800d-8be0fa611d93" />

### 6 - como ficou após alterar a sinopse do filme do superman

<img width="1917" height="872" alt="Captura de tela 2025-08-25 082439" src="https://github.com/user-attachments/assets/3c212dc7-b419-46a1-a313-f583130c622e" />

### 7 - graças ao bootstrap, o visual ficou responsivo

<img width="778" height="413" alt="image" src="https://github.com/user-attachments/assets/4713d471-62b1-4cf0-9add-d99efa4c9d81" />

