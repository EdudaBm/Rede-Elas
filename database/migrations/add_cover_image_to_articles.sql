-- Migration: Adicionar campo cover_image à tabela articles
-- Execute este script se a tabela articles já existir sem o campo cover_image

USE abuse_support_system;

-- Verificar se a coluna já existe antes de adicionar
SET @column_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = 'abuse_support_system'
    AND TABLE_NAME = 'articles'
    AND COLUMN_NAME = 'cover_image'
);

-- Adicionar a coluna apenas se ela não existir
SET @sql = IF(@column_exists = 0, 
    'ALTER TABLE articles ADD COLUMN cover_image VARCHAR(500) NULL AFTER content',
    'SELECT "Coluna cover_image já existe na tabela articles" as message'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
<<<<<<< HEAD

=======
>>>>>>> 4a84a3764cdeb97fa46841006fd33cb274d56da3
