## Introdução
Este projeto consiste em uma API desenvolvida utilizando o
framework Laravel, que permite o cadastro e gerenciamento de informações relacionadas a clientes, produtos e vendas. A API utiliza autenticação JWT (JSON Web Tokens) para garantir a segurança das operações e oferece uma interface GraphQL para consultas flexíveis e eficientes aos dados.

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


## GRAPH QL
### Consumo de Dados das Vendas com GraphQL

- Para consumir os dados da venda utilizando GraphQL, você pode utilizar a seguinte query:

- endpoint /graphql  

```graphql
query {
  vendas {
    data {
      descricao
      valor_total
      data_venda
      cliente {
        nome
        cpf
        email
      }
      items {
        valor_unitario
        valor_total
        produto {
          nome
          descricao
          disponivel
          valor
        }
      }
    }
  }
}

