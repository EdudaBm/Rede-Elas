<?php
// database/fix_orphaned_data.php - Script para corrigir dados órfãos

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/Repositories/autoload.php';

use Repositories\RepositoryManager;

echo "=== Script de Correção de Dados Órfãos ===\n\n";

try {
    $db = Database::getInstance()->getConnection();
    
    // 1. Verificar chat_rooms com user_id inválido
    echo "1. Verificando chat_rooms órfãos...\n";
    $stmt = $db->query("
        SELECT cr.id, cr.user_id, cr.user_name 
        FROM chat_rooms cr 
        LEFT JOIN users u ON cr.user_id = u.id 
        WHERE u.id IS NULL
    ");
    $orphanedChatRooms = $stmt->fetchAll();
    
    if (count($orphanedChatRooms) > 0) {
        echo "   Encontrados " . count($orphanedChatRooms) . " chat_rooms órfãos:\n";
        foreach ($orphanedChatRooms as $room) {
            echo "   - ID: {$room['id']}, user_id: {$room['user_id']}, user_name: {$room['user_name']}\n";
        }
        
        // Deletar chat_rooms órfãos
        $stmt = $db->prepare("DELETE FROM chat_rooms WHERE id = ?");
        foreach ($orphanedChatRooms as $room) {
            $stmt->execute([$room['id']]);
            echo "   ✓ Deletado chat_room ID: {$room['id']}\n";
        }
    } else {
        echo "   ✓ Nenhum chat_room órfão encontrado\n";
    }
    
    // 2. Verificar messages com chat_room_id inválido
    echo "\n2. Verificando messages órfãos...\n";
    $stmt = $db->query("
        SELECT m.id, m.chat_room_id 
        FROM messages m 
        LEFT JOIN chat_rooms cr ON m.chat_room_id = cr.id 
        WHERE cr.id IS NULL
    ");
    $orphanedMessages = $stmt->fetchAll();
    
    if (count($orphanedMessages) > 0) {
        echo "   Encontrados " . count($orphanedMessages) . " messages órfãos:\n";
        foreach ($orphanedMessages as $message) {
            echo "   - ID: {$message['id']}, chat_room_id: {$message['chat_room_id']}\n";
        }
        
        // Deletar messages órfãos
        $stmt = $db->prepare("DELETE FROM messages WHERE id = ?");
        foreach ($orphanedMessages as $message) {
            $stmt->execute([$message['id']]);
            echo "   ✓ Deletado message ID: {$message['id']}\n";
        }
    } else {
        echo "   ✓ Nenhum message órfão encontrado\n";
    }
    
    // 3. Verificar emergency_contacts com user_id inválido
    echo "\n3. Verificando emergency_contacts órfãos...\n";
    $stmt = $db->query("
        SELECT ec.id, ec.user_id, ec.contact_name 
        FROM emergency_contacts ec 
        LEFT JOIN users u ON ec.user_id = u.id 
        WHERE u.id IS NULL
    ");
    $orphanedContacts = $stmt->fetchAll();
    
    if (count($orphanedContacts) > 0) {
        echo "   Encontrados " . count($orphanedContacts) . " emergency_contacts órfãos:\n";
        foreach ($orphanedContacts as $contact) {
            echo "   - ID: {$contact['id']}, user_id: {$contact['user_id']}, contact_name: {$contact['contact_name']}\n";
        }
        
        // Deletar emergency_contacts órfãos
        $stmt = $db->prepare("DELETE FROM emergency_contacts WHERE id = ?");
        foreach ($orphanedContacts as $contact) {
            $stmt->execute([$contact['id']]);
            echo "   ✓ Deletado emergency_contact ID: {$contact['id']}\n";
        }
    } else {
        echo "   ✓ Nenhum emergency_contact órfão encontrado\n";
    }
    
    // 4. Verificar testimonial_likes com testimonial_id inválido
    echo "\n4. Verificando testimonial_likes órfãos...\n";
    $stmt = $db->query("
        SELECT tl.id, tl.testimonial_id 
        FROM testimonial_likes tl 
        LEFT JOIN testimonials t ON tl.testimonial_id = t.id 
        WHERE t.id IS NULL
    ");
    $orphanedLikes = $stmt->fetchAll();
    
    if (count($orphanedLikes) > 0) {
        echo "   Encontrados " . count($orphanedLikes) . " testimonial_likes órfãos:\n";
        foreach ($orphanedLikes as $like) {
            echo "   - ID: {$like['id']}, testimonial_id: {$like['testimonial_id']}\n";
        }
        
        // Deletar testimonial_likes órfãos
        $stmt = $db->prepare("DELETE FROM testimonial_likes WHERE id = ?");
        foreach ($orphanedLikes as $like) {
            $stmt->execute([$like['id']]);
            echo "   ✓ Deletado testimonial_like ID: {$like['id']}\n";
        }
    } else {
        echo "   ✓ Nenhum testimonial_like órfão encontrado\n";
    }
    
    // 5. Verificação final
    echo "\n5. Verificação final de integridade...\n";
    
    $stmt = $db->query("
        SELECT COUNT(*) as total FROM chat_rooms cr 
        LEFT JOIN users u ON cr.user_id = u.id 
        WHERE u.id IS NULL
    ");
    $remainingChatRooms = $stmt->fetch()['total'];
    
    $stmt = $db->query("
        SELECT COUNT(*) as total FROM messages m 
        LEFT JOIN chat_rooms cr ON m.chat_room_id = cr.id 
        WHERE cr.id IS NULL
    ");
    $remainingMessages = $stmt->fetch()['total'];
    
    $stmt = $db->query("
        SELECT COUNT(*) as total FROM emergency_contacts ec 
        LEFT JOIN users u ON ec.user_id = u.id 
        WHERE u.id IS NULL
    ");
    $remainingContacts = $stmt->fetch()['total'];
    
    $stmt = $db->query("
        SELECT COUNT(*) as total FROM testimonial_likes tl 
        LEFT JOIN testimonials t ON tl.testimonial_id = t.id 
        WHERE t.id IS NULL
    ");
    $remainingLikes = $stmt->fetch()['total'];
    
    echo "   Chat rooms órfãos restantes: {$remainingChatRooms}\n";
    echo "   Messages órfãos restantes: {$remainingMessages}\n";
    echo "   Emergency contacts órfãos restantes: {$remainingContacts}\n";
    echo "   Testimonial likes órfãos restantes: {$remainingLikes}\n";
    
    if ($remainingChatRooms == 0 && $remainingMessages == 0 && 
        $remainingContacts == 0 && $remainingLikes == 0) {
        echo "\n✅ Todos os dados órfãos foram corrigidos!\n";
    } else {
        echo "\n⚠️  Ainda existem dados órfãos. Verifique manualmente.\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}

echo "\n=== Script finalizado ===\n";
