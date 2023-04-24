# Api criada na versão 8 do framework laravel

## Cadastro lista de produtos do Open Food.

Os produtos são exportados da base do Open Food Fact.

## Objetivo:
### Desenvolver sistema de atualização que vai importar os dados para a Base de Dados com a versão mais recente do Open Food Facts uma vez ao día. Adicionar aos arquivos de configuração o melhor horário para executar a importação.

funcionalidades:
Detalhes da API, atualizações do Projeto Web, Mudar o status do produto, Obter a informação somente de um produto e Listar todos os produtos da base de dados.

## Observação:
A remoção de produtos é somente a alteração do status dele para trash.


### Rotas da REST API

Na REST API temos um CRUD com os seguintes endpoints:

 - `api/GET/`: Detalhes da API, se conexão leitura e escritura com a base de dados está OK, horário da última vez que o CRON foi executado, tempo online e uso de memória.
 - `api/PUT/products/:code`: Será responsável por receber atualizações do Projeto Web
 - `api/DELETE/products/:code`: Mudar o status do produto para `trash`
 - `api/GET/products/:code`: Obter a informação somente de um produto da base de dados
 - `api/GET/products`: Listar todos os produtos da base de dados, adicionar sistema de paginação para não sobrecarregar o `REQUEST`.

## Rodar o projeto

### Clone o repositório:
```
git clone https://github.com/thig7179/products-parser-20230105.git 
```

### Acesse o projeto:
```
cd .\api-open-food-facts\
```

### Gere o .env:
```
cp .env.example .env && php artisan key:generate
---------------------------------
No .env atribua o nome da base mongodb em DB_DATABASE
```

### Instale as dependências do projeto:
```
composer install
npm install
```

### colocar a seguinte linha no cronjob:
```
* * * * * cd /products-parser-20230105/api-open-food-facts && php artisan schedule:run >> /dev/null 2>&1
```

### Rode o projeto:
```
php artisan serve
```
