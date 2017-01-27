<?php

require_once(classePath . "/autorisation.php");

class AutorisationManager{
    private $db;
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->db= $db;
    }
    
    public function add(Autorisations $autorisation){
        $sql = $this->db->prepare('
            INSERT INTO autorisation(id, libelle) 
            VALUES(:id, :libelle)
        ');
        
        $sql->bindValue(':id', $autorisation->getId());
        $sql->bindValue(':libelle', $autorisation->getLibelle());
        
        $sql->execute();
    }
    
    public function update(Autorisations $autorisation){
        $sql = $this->db->prepare("
            UPDATE autorisation
            SET libelle = :libelle
            WHERE id = :id
        ");
        
        $sql->bindValue(':libelle', $autorisation->getLibelle());
        $sql->bindValue(':id', $autorisation->getId());
        
        $sql->execute();
    }
    
    public function delete(Autorisations $autorisation){
        $this->db->exec("
            UPDATE autorisation
            SET valide = 0
            WHERE id = " . $autorisation->getId()
        );
    }
    
    public function get($id){
        $sql = $this->db->query("
            SELECT * 
            FROM autorisation 
            WHERE valide = 1 
            AND id = $id
        ");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        return new Autorisation($data);
    }
    
    public function getList(){
        $list = [];
        
        $sql = $this->db->query("
            SELECT * 
            FROM autorisation 
            WHERE valide = 1 
            ORDER BY id
        ");
        
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)){
            $list[] = new Autorisation($data);
        }
        
        return $list;
    }
    
    public function getListBySalarie($id){
        $list = [];
        
        $sql = $this->db->query("
            SELECT A.* 
            FROM autorisation A 
            INNER JOIN salarie_autorisation SA ON A.id = SA.idAutorisation
            WHERE idSalarie = $id
            AND A.valide = 1
            AND SA.valide = 1
            ORDER BY id
        ");
        
        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
            $list[] = new Autorisation($data);
        }
        
        return $list;
    }
}

?>