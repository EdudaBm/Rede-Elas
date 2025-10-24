# 🚀 Guia de Deploy - RedeElas

Este guia fornece instruções completas para colocar o projeto RedeElas em produção e hospedá-lo.

## 📋 Pré-requisitos

- Servidor web (Apache/Nginx)
- PHP 8.0 ou superior
- MySQL 5.7 ou superior
- SSL Certificate (recomendado)
- Domínio configurado

## 🏗️ Estrutura do Projeto

```
RedeElas/
├── app/
│   ├── Controllers/
│   ├── Core/
│   ├── Models/
│   └── Views/
├── config/
├── database/
├── public/
├── styles/
├── index.php
└── composer.json (se aplicável)
```

## 🗄️ Configuração do Banco de Dados

### 1. Criar Banco de Dados

```sql
CREATE DATABASE redeelas_prod CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'redeelas_user'@'localhost' IDENTIFIED BY 'senha_forte_aqui';
GRANT ALL PRIVILEGES ON redeelas_prod.* TO 'redeelas_user'@'localhost';
FLUSH PRIVILEGES;
```

### 2. Executar Schema

```bash
mysql -u redeelas_user -p redeelas_prod < database/schema.sql
```

### 3. Configurar Conexão

Edite `config/database.php`:

```php
<?php
return [
    'host' => 'localhost',
    'dbname' => 'redeelas_prod',
    'username' => 'redeelas_user',
    'password' => 'sua_senha_forte',
    'charset' => 'utf8mb4',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]
];
```

## 🌐 Configuração do Servidor Web

### Apache (.htaccess)

Crie um arquivo `.htaccess` na raiz do projeto:

```apache
RewriteEngine On

# Redirecionar para HTTPS (recomendado)
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Front Controller
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]

# Segurança
<Files "*.php">
    Order Allow,Deny
    Allow from all
</Files>

# Headers de Segurança
<IfModule mod_headers.c>
    Header always set X-Content-Type-Options nosniff
    Header always set X-Frame-Options DENY
    Header always set X-XSS-Protection "1; mode=block"
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains"
    Header always set Referrer-Policy "strict-origin-when-cross-origin"
</IfModule>

# Cache para arquivos estáticos
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
</IfModule>
```

### Nginx

Configure o virtual host:

```nginx
server {
    listen 80;
    listen 443 ssl http2;
    server_name seudominio.com www.seudominio.com;
    
    root /var/www/redeelas/public;
    index index.php index.html;
    
    # SSL Configuration
    ssl_certificate /path/to/certificate.crt;
    ssl_certificate_key /path/to/private.key;
    ssl_protocols TLSv1.2 TLSv1.3;
    ssl_ciphers ECDHE-RSA-AES256-GCM-SHA512:DHE-RSA-AES256-GCM-SHA512;
    
    # Security Headers
    add_header X-Frame-Options DENY;
    add_header X-Content-Type-Options nosniff;
    add_header X-XSS-Protection "1; mode=block";
    add_header Strict-Transport-Security "max-age=31536000; includeSubDomains";
    
    # Front Controller
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    # PHP Processing
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    # Static Files Cache
    location ~* \.(css|js|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
    
    # Deny access to sensitive files
    location ~ /\. {
        deny all;
    }
    
    location ~ \.(env|log|sql)$ {
        deny all;
    }
}
```

## 📁 Upload dos Arquivos

### Via FTP/SFTP

1. **Comprimir o projeto** (exceto arquivos desnecessários):
```bash
zip -r redeelas.zip . -x "*.git*" "*.md" "node_modules/*" ".env*"
```

2. **Upload via FTP/SFTP** para o diretório do servidor:
```bash
# Exemplo com scp
scp redeelas.zip usuario@servidor:/var/www/
```

3. **Extrair no servidor**:
```bash
cd /var/www/
unzip redeelas.zip
mv redeelas-* redeelas
```

### Via Git (Recomendado)

```bash
# No servidor
cd /var/www/
git clone https://github.com/seu-usuario/redeelas.git
cd redeelas
```

## ⚙️ Configurações de Produção

### 1. Configurar index.php

Edite `index.php` para ambiente de produção:

```php
<?php
session_start();

// Configurações de produção
define('BASE_PATH', __DIR__);
define('BASE_URL', 'https://seudominio.com'); // Mude para seu domínio

// Autoload
spl_autoload_register(function ($class) {
    $file = BASE_PATH . '/app/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Incluir configurações
require_once BASE_PATH . '/config/database.php';
require_once BASE_PATH . '/app/Core/Router.php';
require_once BASE_PATH . '/app/Core/Controller.php';

// Resto do código...
```

### 2. Configurar Permissões

```bash
# Definir proprietário correto
sudo chown -R www-data:www-data /var/www/redeelas

# Definir permissões
sudo chmod -R 755 /var/www/redeelas
sudo chmod -R 777 /var/www/redeelas/storage # Se houver diretório de uploads
```

### 3. Configurar PHP

Edite `/etc/php/8.1/apache2/php.ini` (ou nginx):

```ini
# Configurações importantes para produção
display_errors = Off
log_errors = On
error_log = /var/log/php_errors.log
max_execution_time = 30
memory_limit = 256M
upload_max_filesize = 10M
post_max_size = 10M
session.cookie_secure = 1
session.cookie_httponly = 1
session.use_strict_mode = 1
```

## 🔒 Segurança

### 1. Configurar Firewall

```bash
# UFW (Ubuntu)
sudo ufw allow 22
sudo ufw allow 80
sudo ufw allow 443
sudo ufw enable

# Ou iptables
iptables -A INPUT -p tcp --dport 22 -j ACCEPT
iptables -A INPUT -p tcp --dport 80 -j ACCEPT
iptables -A INPUT -p tcp --dport 443 -j ACCEPT
```

### 2. Configurar Fail2Ban

```bash
sudo apt install fail2ban
sudo systemctl enable fail2ban
sudo systemctl start fail2ban
```

### 3. Backup Automático

Crie script de backup `/usr/local/bin/backup-redeelas.sh`:

```bash
#!/bin/bash
BACKUP_DIR="/backups/redeelas"
DATE=$(date +%Y%m%d_%H%M%S)
DB_NAME="redeelas_prod"
DB_USER="redeelas_user"
DB_PASS="sua_senha"

# Criar diretório de backup
mkdir -p $BACKUP_DIR

# Backup do banco de dados
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/db_$DATE.sql

# Backup dos arquivos
tar -czf $BACKUP_DIR/files_$DATE.tar.gz /var/www/redeelas

# Manter apenas os últimos 7 backups
find $BACKUP_DIR -name "db_*" -mtime +7 -delete
find $BACKUP_DIR -name "files_*" -mtime +7 -delete

echo "Backup concluído: $DATE"
```

Adicione ao crontab:
```bash
crontab -e
# Adicionar linha:
0 2 * * * /usr/local/bin/backup-redeelas.sh
```

## 🌍 Opções de Hospedagem

### 1. Hospedagem Compartilhada

**Requisitos mínimos:**
- PHP 8.0+
- MySQL 5.7+
- SSL gratuito (Let's Encrypt)
- 1GB de espaço

**Provedores recomendados:**
- Hostinger
- HostGator
- Locaweb
- UOL Host

### 2. VPS (Virtual Private Server)

**Requisitos:**
- 1 vCPU
- 1GB RAM
- 20GB SSD
- Ubuntu 20.04+

**Provedores:**
- DigitalOcean ($5/mês)
- Linode ($5/mês)
- Vultr ($5/mês)
- AWS EC2 t2.micro (gratuito por 1 ano)

### 3. Cloud (Escalável)

**Opções:**
- Google Cloud Platform
- Amazon Web Services
- Microsoft Azure
- Heroku (com adaptações)

## 📊 Monitoramento

### 1. Logs de Acesso

```bash
# Verificar logs do Apache
tail -f /var/log/apache2/access.log
tail -f /var/log/apache2/error.log

# Verificar logs do Nginx
tail -f /var/log/nginx/access.log
tail -f /var/log/nginx/error.log
```

### 2. Monitoramento de Recursos

```bash
# Instalar htop para monitoramento
sudo apt install htop

# Verificar uso de disco
df -h

# Verificar uso de memória
free -h

# Verificar processos
ps aux | grep php
```

### 3. Uptime Monitoring

Use serviços gratuitos:
- UptimeRobot
- Pingdom
- StatusCake

## 🚀 Deploy Automático

### 1. Script de Deploy

Crie `deploy.sh`:

```bash
#!/bin/bash
echo "🚀 Iniciando deploy do RedeElas..."

# Pull do repositório
git pull origin main

# Backup do banco
mysqldump -u redeelas_user -p$DB_PASS redeelas_prod > backup_$(date +%Y%m%d_%H%M%S).sql

# Limpar cache se houver
# php artisan cache:clear # Se usar framework

# Reiniciar serviços
sudo systemctl reload apache2
# ou
sudo systemctl reload nginx

echo "✅ Deploy concluído!"
```

### 2. GitHub Actions (Opcional)

Crie `.github/workflows/deploy.yml`:

```yaml
name: Deploy to Production

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v2
    
    - name: Deploy to server
      uses: appleboy/ssh-action@v0.1.5
      with:
        host: ${{ secrets.HOST }}
        username: ${{ secrets.USERNAME }}
        key: ${{ secrets.SSH_KEY }}
        script: |
          cd /var/www/redeelas
          git pull origin main
          sudo systemctl reload apache2
```

## 📱 Configurações Adicionais

### 1. CDN (Opcional)

Para melhor performance, configure um CDN:
- Cloudflare (gratuito)
- AWS CloudFront
- Google Cloud CDN

### 2. Otimizações

```bash
# Comprimir imagens
sudo apt install jpegoptim optipng
find /var/www/redeelas/public -name "*.jpg" -exec jpegoptim {} \;
find /var/www/redeelas/public -name "*.png" -exec optipng {} \;

# Minificar CSS/JS (se necessário)
# Use ferramentas como UglifyJS, CSSO
```

## 🔧 Troubleshooting

### Problemas Comuns

1. **Erro 500**: Verificar logs de erro do PHP
2. **Erro de conexão com BD**: Verificar credenciais e firewall
3. **Permissões**: Verificar ownership dos arquivos
4. **SSL**: Verificar certificado e configuração

### Comandos Úteis

```bash
# Verificar status dos serviços
sudo systemctl status apache2
sudo systemctl status mysql

# Reiniciar serviços
sudo systemctl restart apache2
sudo systemctl restart mysql

# Verificar configuração do PHP
php -m
php -i | grep error_log

# Testar conexão com banco
mysql -u redeelas_user -p -h localhost redeelas_prod
```

## 📞 Suporte

Para dúvidas ou problemas:
1. Verificar logs de erro
2. Testar em ambiente local
3. Verificar configurações do servidor
4. Consultar documentação do provedor de hospedagem

---

**⚠️ Importante**: Sempre faça backup antes de fazer alterações em produção!

**🔒 Segurança**: Mantenha o sistema atualizado e monitore logs regularmente.

**📈 Performance**: Monitore recursos e otimize conforme necessário.
