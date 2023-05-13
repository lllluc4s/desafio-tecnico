# BuscaRepo

Este é um exemplo de como consumir a API do GitHub para listar os 5 repositórios com mais estrelas de um usuário.

## Pré-requisitos

-   [PHP](https://www.php.net/downloads)
-   [Composer](https://getcomposer.org/download/)

## Instalação

1. Clone o repositório para sua máquina:

```
git clone https://github.com/seu-usuario/github-api-example.git
```

2. Instale as dependências do projeto executando o comando abaixo na pasta raiz do projeto:

```
composer install
```

3. Crie um arquivo `.env` na raiz do projeto e defina as credenciais da API do GitHub:

```
GITHUB_CLIENT_ID=seu_client_id_aqui
GITHUB_CLIENT_SECRET=seu_client_secret_aqui
```

4. Inicie o servidor PHP:

```
php artisan serve
```

5. Acesse o endereço `http://localhost:8000` no navegador para usar a aplicação.

## Uso

1. Digite o nome de um usuário do GitHub na caixa de busca e clique em "Buscar".
2. Serão listados os 5 repositórios do usuário com mais estrelas.
3. Clique no link do repositório para abrir o perfil no GitHub.
