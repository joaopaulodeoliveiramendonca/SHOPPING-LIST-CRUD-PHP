# CRUD de Lista de Compras em PHP - MVC, MySQL e Bootstrap

Este projeto implementa um sistema de CRUD (Create, Read, Update, Delete) para uma lista de compras utilizando **PHP**, **MySQL**, **Bootstrap** e a arquitetura **MVC** (Model-View-Controller). O objetivo é permitir a gestão de itens de uma lista de compras, com operações básicas de CRUD.

## Funcionalidades

- **Adicionar item**: Adiciona novos itens à lista de compras.
- **Editar item**: Permite editar os dados de um item existente.
- **Excluir item**: Remove um item da lista de compras.
- **Listar itens**: Exibe todos os itens da lista de compras.

## Tecnologias Utilizadas

- **PHP**: Linguagem de programação principal.
- **MySQL**: Banco de dados relacional utilizado para armazenar os itens da lista de compras.
- **MVC (Model-View-Controller)**: Arquitetura utilizada para estruturar o código.
- **HTML e CSS**: Estruturação e estilização básica das páginas.

## Estrutura do Projeto

A estrutura do projeto é organizada da seguinte maneira:

```
/compras
  /app
    /controllers
      ListaController.php       # Controlador responsável pelas operações de CRUD
    /models
      Lista.php                 # Modelo que interage com o banco de dados
    /views
      index.php                 # Página principal para listar itens
      add.php                   # Formulário para adicionar novos itens
      edit.php                  # Formulário para editar itens existentes
  /public
    /css
      style.css                 # Arquivo de estilos CSS
    /js
      script.js                 # Arquivo JavaScript (caso necessário)
    index.php                   # Roteamento e controle da aplicação
  /config
    database.php                # Configuração da conexão com o banco de dados
```

## Como Rodar o Projeto

### Requisitos

- **PHP**: Certifique-se de ter o PHP instalado em sua máquina.
- **MySQL**: O banco de dados MySQL deve estar instalado e funcionando.
- **Servidor Web**: Um servidor como Apache ou Nginx para servir o aplicativo.

### Passos para Execução

1. **Clone o repositório**:
   Clone o repositório em seu ambiente local ou servidor.

   ```bash
   git clone https://github.com/joaopaulodeoliveiramendonca/SHOPPING-LIST-CRUD-PHP.git
   cd SHOPPING-LIST-CRUD-PHP
   ```

2. **Configuração do Banco de Dados**:
   - Crie um banco de dados no MySQL com o nome `lista_compras`.
   - Execute o seguinte comando SQL para criar a tabela necessária:

     ```sql
     CREATE TABLE `itens_compras` (
       `id` INT NOT NULL AUTO_INCREMENT,
       `nome` VARCHAR(255) NOT NULL,
       `quantidade` INT NOT NULL,
       `preco` DECIMAL(10, 2) NOT NULL,
       PRIMARY KEY (`id`)
     );
     ```

3. **Configuração do Banco de Dados**:
   - Abra o arquivo `config/database.php` e configure os parâmetros de conexão com o seu banco de dados:

     ```php
     class Database {
         private $host = "localhost";
         private $db_name = "lista_compras";  // Nome do banco de dados
         private $username = "root";           // Seu usuário do MySQL
         private $password = "";               // Sua senha do MySQL
         public $conn;

         public function getConnection() {
             $this->conn = null;

             try {
                 $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                 $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             } catch (PDOException $exception) {
                 echo "Connection error: " . $exception->getMessage();
             }

             return $this->conn;
         }
     }
     ```

4. **Inicie o Servidor Web**:
   - Se estiver utilizando o Apache, certifique-se de que o `mod_rewrite` esteja habilitado e crie um arquivo `.htaccess` para reescrever URLs.

   Exemplo de conteúdo para o `.htaccess`:

```apache
RewriteEngine On

# Reescreve todas as URLs para o index.php
RewriteRule ^(.*)$ public/index.php?url=$1 [QSA,L]
```

   Isso fará com que todas as requisições sejam redirecionadas para o `index.php` para serem processadas pelo controlador.

5. **Acesse o Aplicativo**:
   - Abra seu navegador e acesse o sistema no endereço: `http://localhost/` (ou o endereço configurado no servidor).

   Agora você pode visualizar a lista de compras, adicionar novos itens, editar ou excluir os itens existentes.

## Como Funciona

### 1. **Model** (`Lista.php`)

O **Modelo** é responsável por interagir diretamente com o banco de dados. Ele contém os métodos para criar, ler, atualizar e excluir itens da lista de compras.

### 2. **Controller** (`ListaController.php`)

O **Controlador** recebe as requisições, interage com o modelo e passa os dados para as views. Ele também lida com a validação dos dados e com a lógica de navegação entre as páginas.

### 3. **Views** (`index.php`, `add.php`, `edit.php`)

As **Views** são responsáveis por exibir os dados ao usuário. Elas contêm os formulários de entrada e exibição dos dados da lista de compras.

## Funcionalidades

### Adicionar Item

- Na página inicial, clique em **Adicionar Item** para ser redirecionado ao formulário de criação.
- Preencha os campos de nome, quantidade e preço e clique em **Adicionar**.

### Editar Item

- Na tabela de itens, clique em **Editar** ao lado do item que deseja modificar.
- Faça as alterações necessárias e clique em **Salvar Alterações**.

### Excluir Item

- Na tabela de itens, clique em **Excluir** ao lado do item que deseja remover. Será solicitada uma confirmação antes de excluir o item.

## Melhorias Possíveis

- **Segurança**: Implementar medidas de segurança adicionais, como validação mais robusta dos dados e proteção contra SQL Injection, XSS e CSRF.
- **Autenticação**: Adicionar um sistema de login para restringir o acesso às operações de CRUD.
- **Pesquisa e Filtros**: Adicionar filtros de pesquisa para facilitar a busca por itens específicos na lista.

## Licença

Este projeto está licenciado sob a **MIT License**.
