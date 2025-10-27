-- Script para limpar dados órfãos no banco de dados
-- Execute este script se houver problemas de integridade referencial

-- 1. Verificar usuários órfãos (sessões com user_id que não existe)
-- Primeiro, vamos ver quantos registros problemáticos existem
SELECT 'Verificando dados órfãos...' as status;

-- 2. Verificar chat_rooms com user_id inválido
SELECT 
    'chat_rooms com user_id inválido:' as tabela,
    COUNT(*) as total
FROM chat_rooms cr 
LEFT JOIN users u ON cr.user_id = u.id 
WHERE u.id IS NULL;

-- 3. Verificar messages com chat_room_id inválido
SELECT 
    'messages com chat_room_id inválido:' as tabela,
    COUNT(*) as total
FROM messages m 
LEFT JOIN chat_rooms cr ON m.chat_room_id = cr.id 
WHERE cr.id IS NULL;

-- 4. Verificar emergency_contacts com user_id inválido
SELECT 
    'emergency_contacts com user_id inválido:' as tabela,
    COUNT(*) as total
FROM emergency_contacts ec 
LEFT JOIN users u ON ec.user_id = u.id 
WHERE u.id IS NULL;

-- 5. Verificar testimonial_likes com testimonial_id inválido
SELECT 
    'testimonial_likes com testimonial_id inválido:' as tabela,
    COUNT(*) as total
FROM testimonial_likes tl 
LEFT JOIN testimonials t ON tl.testimonial_id = t.id 
WHERE t.id IS NULL;

-- 6. LIMPEZA (descomente as linhas abaixo para executar a limpeza)
-- ATENÇÃO: Faça backup antes de executar!

-- Deletar chat_rooms órfãos
-- DELETE cr FROM chat_rooms cr 
-- LEFT JOIN users u ON cr.user_id = u.id 
-- WHERE u.id IS NULL;

-- Deletar messages órfãos
-- DELETE m FROM messages m 
-- LEFT JOIN chat_rooms cr ON m.chat_room_id = cr.id 
-- WHERE cr.id IS NULL;

-- Deletar emergency_contacts órfãos
-- DELETE ec FROM emergency_contacts ec 
-- LEFT JOIN users u ON ec.user_id = u.id 
-- WHERE u.id IS NULL;

-- Deletar testimonial_likes órfãos
-- DELETE tl FROM testimonial_likes tl 
-- LEFT JOIN testimonials t ON tl.testimonial_id = t.id 
-- WHERE t.id IS NULL;

-- 7. Verificar integridade após limpeza
SELECT 'Verificação final de integridade...' as status;

-- Verificar se ainda existem problemas
SELECT 
    'chat_rooms restantes com problemas:' as status,
    COUNT(*) as total
FROM chat_rooms cr 
LEFT JOIN users u ON cr.user_id = u.id 
WHERE u.id IS NULL;

SELECT 
    'messages restantes com problemas:' as status,
    COUNT(*) as total
FROM messages m 
LEFT JOIN chat_rooms cr ON m.chat_room_id = cr.id 
WHERE cr.id IS NULL;

SELECT 
    'emergency_contacts restantes com problemas:' as status,
    COUNT(*) as total
FROM emergency_contacts ec 
LEFT JOIN users u ON ec.user_id = u.id 
WHERE u.id IS NULL;

SELECT 
    'testimonial_likes restantes com problemas:' as status,
    COUNT(*) as total
FROM testimonial_likes tl 
LEFT JOIN testimonials t ON tl.testimonial_id = t.id 
WHERE t.id IS NULL;
