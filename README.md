<p align="center"><a href="https://czrsolutions.com/" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## AO CLONAR O PROJETO

### CRIE O BANCO DE DADOS E DEFINA OS PARÂMETROS
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=banco
    DB_USERNAME=user
    DB_PASSWORD=password

### EXECUTE OS SEGUINTES COMANDOS

- composer install 
- copie o .env.example para .env 
- php artisan key:generate
- php artisan optimize:clear
- php artisan migrate

### CRIE OS TIPOS DE PRODUTOS E O USER ADMIN

- php artisan db:seed --class=TipoProdutoSeeder
- php artisan db:seed --class=UsersTableSeeder

### GERE A CHAVE PARA ENCRIPTAR O TOKEN JWT
- php artisan jwt:secret

### OBTENDO O TOKEN  ( /api/login )
- PASSE AS CREDÊNCIAS NO CORPO DA REQUISIÇÃO

  { "email": "admin@email.com","password": "senha123" }


- Use o token em Authorization Bearer Token ou no Headers para as demais requisições
