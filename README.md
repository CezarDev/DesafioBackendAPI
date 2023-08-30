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


- php artisan optimize:clear
- php artisan migrate
- php artisan db:seed --class=TipoProdutoSeeder

