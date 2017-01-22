<?php

require_once(classePath . "/salarie.php");

class SalarieManager{
    private $db;
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->db = $db;
    }
    
    public function add(Salarie $salarie){
        $sql = $this->db->prepare('
            INSERT INTO salarie(id, idService, nom, prenom, mdp) 
            VALUES(:id, :idService, :nom, :prenom, :mdp)
        ');
        
        $sql->bindValue(':id', $salarie->getId());
        $sql->bindValue(':idService', $salarie->service->getId());
        $sql->bindValue(':nom', $salarie->getNom());
        $sql->bindValue(':prenom', $salarie->getPrenom());
        $sql->bindValue(':mdp', $salarie->getMdp());
        
        $sql->execute();
    }
    
    public function update(Salarie $salarie){
        $sql = $this->db->prepare('
            UPDATE salarie 
            SET idService = :idService, nom = :nom, prenom = :prenom, mdp = :mdp
            WHERE id = :id
        ');
        
        $sql->bindValue(':idService', $salarie->service->getId());
        $sql->bindValue(':nom', $salarie->getNom());
        $sql->bindValue(':prenom', $salarie->getPrenom());
        $sql->bindValue(':mdp', $salarie->getMdp());
        $sql->bindValue(':id', $salarie->getId());
        
        $sql->execute();
    }
    
    public function delete(Salarie $salarie){
        $this->db->exec('
            UPDATE salarie
            SET valide = 0
            WHERE id = ' . $salarie->getId()
        );
    }
    
    public function get($id){
        $sql = $this->db->query('SELECT * FROM salarie WHERE valide = 1 AND id = '.$id);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        $seManager = new ServiceManager($this->db);
        $data["service"] = $seManager->get($data["idService"]);
        unset($data["idService"]);
        
        $aManager = new AutorisationManager($this->db);
        $data["autorisations"] = $aManager->getListBySalarie($id);
        
        return new Salarie($data);
    }
    
    public function getList(){
        $list = [];
        
        $sql = $this->db->query('SELECT * FROM salarie WHERE valide = 1 ORDER BY nom ');
        
        $seManager = new ServiceManager($this->db);
        $aManager = new AutorisationManager($this->db);
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)){        
            $data["service"] = $seManager->get($data["idService"]);
            unset($data["idService"]);
            
            $data["autorisations"] = $aManager->getListBySalarie($data["id"]);
            
            $list[] = new Salarie($data);
        }
        
        return $list;
    }
    
    public function getListFromService(Service $service){
        $list = [];
        
        $sql = $this->db->query("SELECT * FROM salarie WHERE valide = 1 AND idService = ".$service->getId()." ORDER BY nom ");
        
        $seManager = new ServiceManager($this->db);
        $aManager = new AutorisationManager($this->db);
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)){        
            $data["service"] = $seManager->get($data["idService"]);
            unset($data["idService"]);
            
            $data["autorisations"] = $aManager->getListBySalarie($data["id"]);
            
            $list[] = new Salarie($data);
        }
        
        return $list;
    }
    
    public function authentification($nom, $mdp){
        $salaries = $this->getList();
        
        foreach($salaries as $salarie){
            foreach($salarie->getAutorisations() as $autorisation){
                if($autorisation->getId() == 2){
                    $acces = true;
                }
            }
            
            if($salarie->getNom() == strtolower($nom) && $salarie->getMdp() == $mdp && isset($acces)){
                return $salarie;
            }
        }
        
        return null;
    }
}

?>