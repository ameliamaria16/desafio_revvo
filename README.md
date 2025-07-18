# Desafio Revvo

Este projeto é uma aplicação web desenvolvida em PHP para gerenciamento de cursos e slides, como parte do Desafio Revvo.

## Funcionalidades

- Cadastro, edição e exclusão de cursos
- Cadastro, edição e exclusão de slides para slideshow
- Gerenciamento de categorias de cursos
- Registro de logs de ações administrativas

## Estrutura do Projeto

- `database/schema.sql`: Script para criação do banco de dados e tabelas necessárias.
- `public/`: Pasta pública do projeto, onde está o ponto de entrada da aplicação.
- `src/`: Contém os arquivos de configuração, controladores e modelos.

## Pré-requisitos

- PHP 7.4 ou superior
- XAMPP (ou outro ambiente com Apache e MySQL)
- Composer (opcional, caso queira gerenciar dependências PHP)

## Como Executar

1. **Clone o repositório e acesse a pasta do projeto:**

  ```bash
   git clone https://github.com/ameliamaria16/desafio_revvo.git
   cd desafio_revvo
   ```

2. **Crie o banco de dados:**

 - Abra o painel do XAMPP e inicie o Apache e o MySQL.
   - **Usando o HeidiSQL:**  
     - Abra o HeidiSQL e conecte-se ao seu servidor MySQL.  
     - Clique com o botão direito na conexão e selecione "Nova consulta".  
     - Abra o arquivo `database/schema.sql`, copie todo o conteúdo e cole na aba de consulta do HeidiSQL.  
     - Execute a consulta (F9).  
   - **Ou, se preferir, use o phpMyAdmin:**  
     - Acesse o phpMyAdmin (geralmente em [http://localhost/phpmyadmin](http://localhost/phpmyadmin)).  
     - Importe o arquivo `database/schema.sql` para criar o banco de dados e as tabelas.
3. **Execute o servidor embutido do PHP:**

   No terminal, navegue até a pasta `public`:

   ```bash
   cd public
   php -S localhost:8000
   ```

4. **Acesse a aplicação:**

   Abra o navegador e acesse [http://localhost:8000](http://localhost:8000).

## Observações

- Certifique-se de que o MySQL está rodando e que o banco de dados foi criado corretamente.
- Os arquivos de configuração de conexão com o banco estão em `src/config/conexao.php` e `src/config/database.php`. Ajuste-os se necessário para o seu ambiente.

## Licença

Este projeto é apenas para fins de estudo e desafio técnico.

---

Se tiver dúvidas ou problemas, fique à vontade para abrir uma issue ou entrar em contato. 