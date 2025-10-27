<?php
// app/Repositories/RepositoryInterface.php - Interface base para repositórios

namespace Repositories;

interface RepositoryInterface {
    /**
     * Buscar um registro por ID
     */
    public function findById($id);
    
    /**
     * Buscar todos os registros
     */
    public function findAll($limit = null, $offset = 0);
    
    /**
     * Criar um novo registro
     */
    public function create(array $data);
    
    /**
     * Atualizar um registro
     */
    public function update($id, array $data);
    
    /**
     * Deletar um registro
     */
    public function delete($id);
    
    /**
     * Contar registros
     */
    public function count();
}
