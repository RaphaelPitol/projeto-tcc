<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Sistema de Automação de Vistorias Imobiliárias - VISTORIAPRO

Este projeto é parte do Trabalho de Conclusão de Curso (TCC) e tem como objetivo desenvolver um sistema web para automação de vistorias imobiliárias, otimizando o processo de inspeção, garantindo a integridade dos dados e fornecendo relatórios claros e estruturados.

---

## 🚀 Funcionalidades Principais

- **Cadastro e Gerenciamento de Usuários:**
  - Permissões diferenciadas para administradores, imobiliárias e vistoriadores.
  - Controle de acesso baseado em permissões.

- **Gestão de Vistorias:**
  - Cadastro de vistorias vinculadas a imobiliárias.
  - Designação de vistorias a vistoriadores específicos.
  - Geração de relatórios detalhados em PDF com informações de cada ambiente vistoriado, incluindo assinaturas das partes envolvidas.

- **Automação de Dados:**
  - Integração com o **ViaCEP** para preenchimento automático de informações de endereço.
  - Validação de CNPJs utilizando a **API BuscarCNPJ**.

- **Segurança:**
  - Armazenamento de senhas criptografadas.
  - Prevenção contra tentativas de acesso não autorizado e manipulação direta de URLs.
  - Encerramento automático de sessões após período de inatividade.

- **Usabilidade e Interface:**
  - Interface intuitiva e responsiva desenvolvida com **Bootstrap**.
  - Exibição de rotas interativas no perfil do vistoriador com integração a mapas.

- **Relatórios e Integrações:**
  - Exportação de informações das vistorias em formato PDF.
  - Exclusividade e privacidade dos dados para cada imobiliária.

---

## 🛠️ Tecnologias Utilizadas

- **Backend:** Laravel 10
- **Frontend:** Bootstrap 5
- **Banco de Dados:** MySQL
- **Integrações:**
  - ViaCEP (para consulta de endereços)
  - BuscarCNPJ (para validação e consulta de CNPJs)

---

## 📑 Requisitos do Sistema

- **PHP:** >= 8.1
- **Composer:** >= 2.x
- **Node.js:** >= 18.x (para gerenciamento de dependências do frontend)
- **Banco de Dados:** MySQL 5.7 ou superior

---

## ⚙️ Instalação Local

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/seu-repositorio.git

2. Instale as dependências do projeto:
   ```bash
   composer install
   npm install

3. Configure o arquivo .env
   ```bash 
   DB_DATABASE=nome do banco de dados

   Mailtrap usado para resetar a senha
   MAIL_MAILER=smtp
   MAIL_HOST=sandbox.smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=5ceeb7050387b6
   MAIL_PASSWORD=72bc726511f3d2
   MAIL_ENCRYPTION=null
   MAIL_FROM_ADDRESS="hello@example.com"
   MAIL_FROM_NAME="${APP_NAME}"

5. Gere a chave da aplicação:
   ```bash
   php artisan key:generate

6. Execute as migrations:
   ```bash
   php artisan migrate

7. Inicie o servidor local:
   ```bash
   php artisan serve

8. Acesse a aplicação:
   ```bash
   URL padrão: http://localhost:8000

## 👥 Desenvolvedores responsáveis pelo TCC.
1. Raphael Pitol Juliani: https://github.com/RaphaelPitol
2. Mônica Kazumi Fujiharu Fujibayashi: https://github.com/Monicakazumi


## 🔗 Link do Projeto
https://vistoria-pro.infra.bytework.app.br/
