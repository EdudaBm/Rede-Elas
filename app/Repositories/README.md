# Repositórios - Rede Elas

Esta pasta contém todos os repositórios responsáveis por gerenciar as comunicações com o banco de dados.

## Estrutura

- `RepositoryInterface.php` - Interface base para todos os repositórios
- `BaseRepository.php` - Classe base com operações CRUD genéricas
- `RepositoryManager.php` - Gerenciador centralizado dos repositórios
- `UserRepository.php` - Repositório para usuários
- `ArticleRepository.php` - Repositório para artigos
- `ChatRoomRepository.php` - Repositório para salas de chat
- `MessageRepository.php` - Repositório para mensagens
- `EmergencyContactRepository.php` - Repositório para contatos de emergência
- `TestimonialRepository.php` - Repositório para depoimentos

## Como usar

### Usando o RepositoryManager (Recomendado)

```php
use Repositories\RepositoryManager;

$repoManager = RepositoryManager::getInstance();

// Repositório de usuários
$userRepo = $repoManager->user();
$user = $userRepo->findById(1);

// Repositório de artigos
$articleRepo = $repoManager->article();
$articles = $articleRepo->getPublished(10);

// Repositório de mensagens
$messageRepo = $repoManager->message();
$messages = $messageRepo->getByChatRoom(1);
```

### Usando repositórios diretamente

```php
use Repositories\UserRepository;
use Repositories\ArticleRepository;

$userRepo = new UserRepository();
$user = $userRepo->findByUsername('admin');

$articleRepo = new ArticleRepository();
$article = $articleRepo->findBySlug('meu-artigo');
```

## Vantagens dos Repositórios

1. **Separação de responsabilidades**: Lógica de banco de dados separada dos modelos
2. **Reutilização**: Métodos podem ser reutilizados em diferentes controladores
3. **Testabilidade**: Fácil de mockar para testes
4. **Manutenibilidade**: Mudanças na estrutura do banco ficam centralizadas
5. **Consistência**: Padrão uniforme para todas as operações de banco

## Migração dos Modelos

Os modelos atuais podem ser gradualmente migrados para usar os repositórios:

```php
// Antes (no modelo)
class User {
    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
}

// Depois (usando repositório)
class User {
    private $userRepo;
    
    public function __construct() {
        $this->userRepo = RepositoryManager::getInstance()->user();
    }
    
    public function findByUsername($username) {
        return $this->userRepo->findByUsername($username);
    }
}
```
