<?php

require_once(classePath . "/typeHeure.php");

class TypeHeureManager{
    private $db;
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->db= $db;
    }
    
    public function add(TypeHeure $typeHeure){
        $sql = $this->db->prepare('
            INSERT INTO typeheure(id, libelle) 
            VALUES(:id, :libelle)
        ');
        
        $sql->bindValue(':id', $typeHeure->getId());
        $sql->bindValue(':libelle', $typeHeure->getLibelle());
        
        $sql->execute();
    }
    
    public function update(TypeHeure $typeHeure){
        $sql = $this->db->prepare('
            UPDATE typeheure
            SET libelle = :libelle
            WHERE id = :id
        ');
        
        $sql->bindValue(':libelle', $typeHeure->getLibelle());
        $sql->bindValue(':id', $typeHeure->getId());
        
        $sql->execute();
    }
    
    public function delete(TypeHeure $typeHeure){
        $this->db->exec('
            UPDATE typeheure
            SET valide = 0
            WHERE id = ' . $typeHeure->getId()
        );
    }
    
    public function get($id){
        $sql = $this->db->query('SELECT * FROM typeheure WHERE valide = 1 AND id = '.$id);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        return new TypeHeure($data);
    }
    
    public function getList(){
        $list = [];
        
        $sql = $this->db->query('SELECT * FROM typeheure WHERE valide = 1 ORDER BY id ');
        
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)){
            $list[] = new TypeHeure($data);
        }
        
        return $list;
    }
}

?>