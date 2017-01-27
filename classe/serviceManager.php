<?php

require_once(classePath . "/service.php");

class ServiceManager{
    private $db;
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->db= $db;
    }
    
    public function add(Service $service){
        $sql = $this->db->prepare('
            INSERT INTO service(id, libelle) 
            VALUES(:id, :libelle)
        ');
        
        $sql->bindValue(':id', $service->getId());
        $sql->bindValue(':libelle', $service->getLibelle());
        
        $sql->execute();
    }
    
    public function update(Service $service){
        $sql = $this->db->prepare('
            UPDATE service
            SET libelle = :libelle
            WHERE id = :id
        ');
        
        $sql->bindValue(':libelle', $service->getLibelle());
        $sql->bindValue(':id', $service->getId());
        
        $sql->execute();
    }
    
    public function delete(Service $service){
        $this->db->exec('
            DELETE FROM service
            WHERE id = ' . $service->getId()
        );
    }
    
    public function get($id){
        $sql = $this->db->query('SELECT * FROM service WHERE valide = 1 AND id = '.$id);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        return new Service($data);
    }
    
    public function getList(){
        $list = [];
        
        $sql = $this->db->query('SELECT * FROM service WHERE valide = 1 ORDER BY id ');
        
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)){
            $list[] = new Service($data);
        }
        
        return $list;
    }
}

?>