## Sobre o projeto

Sistema simples de MMN Bonifíca.

Tecnologia utilizada:
 - [x] PHP 8.1
 - [x] Laravel 10
 - [x] HTML5, CSS3, Blade, Tailwind

## Instalação

`1°:` Clone o repositório em seu ambiente.

`2°:` utilize o comando:
```
composer install
```
`3°:` Adicione as informações do seu projeto no .env [Dados do banco de dados, nome do projeto, url, etc...]

`4°:` utilize o comando:
```
php artisan migrate --seed 
```

`5°:` utilize o comando:
```
npm install && npm run dev
```

`5°:` utilize o comando:
```
php artisan serve
```
PS: Seu terminal mostrará a url para acessar o projeto

## Utilização do sistema

Ao rodar o comando:
```
php artisan migrate --seed 
```

O terminal irá pedir o número de usuários fake a ser cadastrado, por padrão ele preenche com 6

Após a instalação você terá o usuário admin:
    - admin@teste.com
    - 123456789

Também terá os usuários cadastrados:
    - usuario_{numero-do-usuario-que-quiser-acessar}@teste.com
    - EX: usuario_2@teste.com
    - 123456789
