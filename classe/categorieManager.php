<?php

require_once(classePath . "/categorie.php");

class CategorieManager{
    private $db;
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->db= $db;
    }
    
    public function add(Categorie $categorie){
        $sql = $this->db->prepare('
            INSERT INTO categorie(id, libelle) 
            VALUES(:id, :libelle)
        ');
        
        $sql->bindValue(':id', $categorie->getId());
        $sql->bindValue(':libelle', $categorie->getLibelle());
        
        $sql->execute();
    }
    
    public function update(Categorie $categorie){
        $sql = $this->db->prepare('
            UPDATE categorie
            SET libelle = :libelle
            WHERE id = :id
        ');
        
        $sql->bindValue(':libelle', $categorie->getLibelle());
        $sql->bindValue(':id', $categorie->getId());
        
        $sql->execute();
    }
    
    public function delete(Categorie $categorie){
        $this->db->exec('
            UPDATE categorie
            SET valide = 0
            WHERE id = ' . $categorie->getId()
        );
    }
    
    public function get($id){
        $sql = $this->db->query('SELECT * FROM categorie WHERE valide = 1 AND id = '.$id);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        return new Categorie($data);
    }
    
    public function getList(){
        $list = [];
        
        $sql = $this->db->query('SELECT * FROM categorie WHERE valide = 1 ORDER BY id ');
        
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)){
            $list[] = new Categorie($data);
        }
        
        return $list;
    }
}

?>