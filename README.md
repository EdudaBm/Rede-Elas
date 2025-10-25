# Rede Elas - Sistema de Apoio para Mulheres

Uma plataforma segura e confiável de apoio para mulheres em situação de violência doméstica.

## 🎯 Sobre o Projeto

A Rede Elas foi desenvolvida para oferecer um espaço seguro, anônimo e confiável onde mulheres podem:
- Buscar apoio emocional através de chat com voluntárias treinadas
- Compartilhar suas histórias de superação
- Acessar informações importantes sobre direitos e recursos
- Conectar-se com uma comunidade de apoio

## 👥 Integrantes

- Eduarda Beato 12303038@aluno.cotemig.com.br
- Fellipe Marzano 12301779@aluno.cotemig.com.br
- Gabriela Magalhães 12302015@aluno.cotemig.com.br
- Kaue Gibson 12300756@aluno.cotemig.com.br
- Lucas Lima 12302287@aluno.cotemig.com.br
- Maria Eduarda Freitas 12301698@aluno.cotemig.com.br

## ✨ Características

### 🔒 Segurança e Privacidade
- Conexão segura e criptografada
- Anonimato garantido
- Botão de saída rápida
- Botão de emergência para situações críticas

### 💬 Chat de Apoio
- Chat anônimo com voluntárias treinadas
- Disponibilidade 24/7
- Interface intuitiva e responsiva
- Sistema de moderação

### 📝 Depoimentos
- Compartilhamento anônimo de histórias
- Sistema de moderação para garantir segurança
- Sistema de likes para apoio da comunidade

### 👩‍💼 Painel Administrativo
- Moderação de depoimentos
- Gerenciamento de chats
- Estatísticas do sistema

## 🚀 Tecnologias Utilizadas

- **Backend**: PHP 8+ com arquitetura MVC
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework CSS**: Tailwind CSS
- **Banco de Dados**: MySQL
- **Design**: Sistema de design focado em confiança e segurança

## 📁 Estrutura do Projeto

```
RedeElas/
├── app/
│   ├── Controllers/          # Controladores MVC
│   ├── Models/              # Modelos de dados
│   ├── Views/               # Views/templates
│   │   ├── auth/           # Páginas de autenticação
│   │   ├── blog/           # Páginas do blog
│   │   ├── chat/           # Páginas de chat
│   │   ├── admin/          # Painel administrativo
│   │   ├── layout/         # Layout base
│   │   └── ...
│   └── Core/               # Classes base do sistema
├── config/                 # Configurações
├── database/              # Scripts de banco de dados
├── public/               # Arquivos públicos
└── styles/              # Estilos CSS
```

## 🛠️ Instalação

### Pré-requisitos
- PHP 8.0 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx)

### Passos de Instalação

1. **Clone o repositório**
   ```bash
   git clone [url-do-repositorio]
   cd RedeElas
   ```

2. **Configure o banco de dados**
   - Crie um banco de dados MySQL chamado `redeelas`
   - Execute o script `database/schema.sql` para criar as tabelas

3. **Configure as credenciais do banco**
   - Edite o arquivo `config/database.php` com suas credenciais

4. **Inicie o servidor**
   ```bash
   php -S localhost:8000
   ```

5. **Acesse a aplicação**
   - Abra seu navegador em `http://localhost:8000`

## 👤 Usuários Padrão

### Administrador
- **Usuário**: `admin`
- **Senha**: `admin123`

## 🎨 Design System

O projeto utiliza um design system focado em transmitir confiança e segurança:

### Cores Principais
- **Azul Confiável**: `#2563eb` - Para elementos principais
- **Verde Seguro**: `#059669` - Para ações positivas
- **Vermelho Emergência**: `#dc2626` - Para situações críticas
- **Roxo Esperança**: `#7c3aed` - Para elementos especiais

### Componentes
- Cards com sombras suaves
- Botões com estados hover
- Animações sutis
- Ícones expressivos
- Tipografia clara e legível

## 🔧 Funcionalidades

### Para Usuárias
- ✅ Login anônimo
- ✅ Chat de apoio
- ✅ Compartilhamento de depoimentos
- ✅ Visualização de histórias de superação
- ✅ Acesso a informações importantes

### Para Administradores
- ✅ Moderação de depoimentos
- ✅ Gerenciamento de chats
- ✅ Visualização de estatísticas
- ✅ Controle de usuários

### Para Voluntárias
- ✅ Atendimento de chats
- ✅ Interface de chat otimizada
- ✅ Histórico de conversas

## 🚨 Recursos de Segurança

- **Saída Rápida**: Botão que redireciona para Google
- **Emergência**: Botão para ligar para 190
- **Anonimato**: Sistema que não armazena dados pessoais
- **Moderação**: Todos os depoimentos são moderados
- **Criptografia**: Conexão segura

## 📞 Números de Emergência

- **190** - Polícia Militar
- **180** - Central de Atendimento à Mulher
- **188** - CVV (Apoio Emocional)

## 🤝 Contribuição

Este é um projeto de apoio social. Se você quiser contribuir:

1. Entre em contato através do chat de apoio
2. Compartilhe sua história de superação
3. Ajude outras mulheres através da comunidade

## 🚀 Deploy em Produção

Para instruções detalhadas sobre como colocar o projeto em produção e hospedar o site, consulte o arquivo [DEPLOYMENT.md](DEPLOYMENT.md) que inclui:

- Configuração do servidor web (Apache/Nginx)
- Setup do banco de dados MySQL
- Configurações de segurança
- Opções de hospedagem
- Scripts de backup e monitoramento
- Troubleshooting comum

## 📄 Licença

Este projeto é desenvolvido para fins de apoio social e não possui fins lucrativos.

## 💝 Agradecimentos

Agradecemos a todas as mulheres que compartilharam suas histórias e a todas as voluntárias que dedicam seu tempo para apoiar outras mulheres.

---

**Lembre-se**: Você não está sozinha. A Rede Elas está aqui para te apoiar. 💙
