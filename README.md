# Default Laravel Project
Projeto padrão configurado em Docker utilizando PHP v7.4, Laravel v8.12, InfyOm v8.0 e AdminLTE v3.0.5.
  
## Instalação
Após clonar este repositório, renomeie a pasta para o nome do projeto e remova as configurações do git com:
```php
rm -rf .git
```
Altere o texto "changeme" dos arquivos **.env.example** e **docker-compose.yml**.

Para subir o projeto, abra um terminal em sua pasta e execute:
```php
make up
```
Deixe este terminal executando enquanto estiver utilizando o projeto.

Para acessar o bash do Docker, abra um novo terminal na pasta do projeto e execute:
```php
make sh
```
Quando um projeto estiver usando Docker, todos os comandos devem ser executados dentro deste bash.

Para acessar o banco do Docker, abra um novo terminal na pasta do projeto e execute:
```php
make sh:db
```

## Geração dos CRUDs
Coloque os JSONs na raiz do projeto, dentro da pasta **jsons**. Em seguida, execute o comando abaixo para cada json, corrigindo "ModelName", "table_name" e "00_table_name" para o que for adequado:
```php
php artisan infyom:scaffold ModelName --tableName=table_name --datatables=true --paginate=25 --fieldsFile=/jsons/00_table_name.json
```

## Configuração Inicial
Após a geração dos CRUDs, verificar os arquivos criados conforme as orientações a seguir:
- Conferir migrations
- Atualizar "config/enums.php"
- Atualizar "database/seeders/SetupSeeder.php"
- Criar "database/seeders/DummySeeder.php"
- Atualizar models que utilizam arquivos, seus formulários ("files" => true) e criar observers ("AppServiceProvider")
- Corrigir hierarquia de menus e rotas, criando os middlewares necessários
- Nas controllers, utilizar find em "current-entity" invés de no repositório
- Mos models, criar atributos readable e setters necessários
- Exibir atributos readable em show_fields
- Exibir atributos readable nas datatables (conferir order e filter)
- Conferir formulários, validações e adicionar máscaras
- Atualizar ícones do menu lateral
- Atualizar cores em "public/css/custom_colors.css"
- Atualizar e-mails em "resources/views/vendor/notifications"
- Procurar no código por "TODO:" e corrigir o que for necessário