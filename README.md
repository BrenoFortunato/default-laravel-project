# Default Laravel Project
Projeto padrão configurado em Docker utilizando PHP v7.4, Laravel v8.12, InfyOm v8.0 e AdminLTE v3.0.5.
  
## Instalação
Após clonar este repositório, renomeie a pasta criada para o nome do projeto. Abra um terminal na pasta do projeto e remova as configurações deste git executando o comando abaixo:
```php
rm -rf .git
```

Em seguida, altere o texto "changeme" dos arquivos **.env.example** e **docker-compose.yml** e adicione o endereço de APP_URL ao arquivo de hosts do sistema operacional, da seguinte forma:
```php
127.0.0.1           dev.changeme.com.br
```

Para **iniciar o Docker**, abra um terminal na pasta do projeto e execute o comando abaixo. Deixe este terminal executando enquanto estiver utilizando o projeto:
```php
make up
```

Para acessar o **bash do Docker**, abra um novo terminal na pasta do projeto e execute o comando abaixo. Todos os comandos do Laravel ("php artisan", "composer update", etc.) devem ser executados dentro deste bash:
```php
make sh
```

Para acessar o **banco do Docker**, abra um novo terminal na pasta do projeto e execute:
```php
make sh:db
```

## Geração dos CRUDs
Coloque os jsons na raiz do projeto, dentro da pasta **jsons**. Em seguida, execute o comando abaixo uma vez para cada json, corrigindo "ModelName", "table_name" e "00_table_name" de acordo com o CRUD a ser gerado:
```php
php artisan infyom:scaffold ModelName --tableName=table_name --datatables=true --paginate=25 --fieldsFile=/jsons/00_table_name.json
```

## Configuração Inicial
Após a geração dos CRUDs, verificar os arquivos criados conforme as orientações a seguir:
- Conferir migrations;
- Atualizar "config/enums.php";
- Atualizar "database/seeders/SetupSeeder.php";
- Criar "database/seeders/DummySeeder.php";
- Atualizar model de usuário;
- Atualizar models que utilizam arquivos, seus formulários ("files" => true) e criar observers ;("AppServiceProvider")
- Corrigir hierarquia de menus e rotas, criando os middlewares necessários;
- Nas controllers, utilizar find em "current-entity" invés de no repositório;
- Mos models, criar atributos readable e setters necessários;
- Exibir atributos readable em show_fields;
- Exibir atributos readable nas datatables (conferir order e filter);
- Conferir formulários, validações e adicionar máscaras;
- Atualizar ícones do menu lateral;
- Atualizar cores em "public/css/custom_colors.css";
- Atualizar cores dos e-mails em "resources/views/vendor/notifications";
- Procurar no código por "TODO:" e finalizar o que faltar.