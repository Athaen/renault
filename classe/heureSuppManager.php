<?php

require_once(classePath . "/heureSupp.php");

class HeureSuppManager{
    private $db;
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->db= $db;
    }
    
    public function persist(HeureSupp $heureSupp){        
        if(!empty($heureSupp->getId())){
            $sql = $this->db->prepare('
                UPDATE heureSupp
                SET idSalarie = :idSalarie , datetime = :datetime, heure = :heure
                WHERE id = :id
            ');
        }
        else{
            $sql = $this->db->prepare('
                INSERT INTO heureSupp(id, idSalarie, datetime, heure)
                VALUES(:id, :idSalarie, :datetime, :heure)
            ');
        }
        
        $sql->bindValue(':id', $heureSupp->getId());
        $sql->bindValue(':idSalarie', $heureSupp->getSalarie()->getId());
        $sql->bindValue(':datetime', $heureSupp->getDatetime()->format("Y-m-d H:i:s"));
        $sql->bindValue(':heure', $heureSupp->getHeure());
        
        $sql->execute();
    }
    
    public function delete(HeureSupp $heureSupp){
        $this->db->exec('
            DELETE FROM heureSupp
            WHERE id = ' . $heureSupp->getId()
        );
    }
    
    public function get($id){
        $saManager = new SalarieManager($this->db);
        
        $sql = $this->db->query('SELECT * FROM heureSupp WHERE id = '.$id);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        $data["datetime"] = new DateTime($data["datetime"]);        
        $data["salarie"] = $saManager->get($data["idSalarie"]);
        unset($data["idSalarie"]);
        
        return new HeureSupp($data);
    }
    
    public function getBySalarieDate(Salarie $salarie, DateTime $datetime){
        $annee = $datetime->format("Y");
        
        $sql = $this->db->query("
            SELECT *
            FROM heureSupp
            WHERE idSalarie = ".$salarie->getId()."
            AND YEAR(datetime) = $annee
        ");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($data)){
            $saManager = new SalarieManager($this->db);
            
            $data["datetime"] = new DateTime($data["datetime"]);
            $data["salarie"] = $saManager->get($data["idSalarie"]);
            
            return new HeureSupp($data);
        }
        else{
            return null;
        }
        
    }
    
    public function getList(){
        $list = []  ;
        
        $sql = $this->db->query('SELECT * FROM report ORDER BY datetime ');
        
        $saManager = new SalarieManager($this->db);
        
        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
            $data["datetime"] = new DateTime($data["datetime"]);
            $data["salarie"] = $saManager->get($data["idSalarie"]);
            
            $list[] = new Report($data);
        }
        
        return $list;
    }    
}

?>