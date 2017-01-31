<?php

require_once(classePath . "/heure.php");

class heureManager{
    private $db;
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->db= $db;
    }
    
    public function persist(Heure $heure){        
        if(!empty($heure->getId())){
            $sql = $this->db->prepare('
                UPDATE heure
                SET idSalarie = :idSalarie, idTypeHeure = :idTypeHeure, datetime = :datetime, hr_ht_r = :hr_ht_r
                WHERE id = :id
            ');
        }
        else{
            $sql = $this->db->prepare('
                INSERT INTO heure(id, idSalarie, idTypeHeure, datetime, hr_ht_r) 
                VALUES(:id, :idSalarie, :idTypeHeure, :datetime, :hr_ht_r)
            ');
        }
        
        $sql->bindValue(':id', $heure->getId());
        $sql->bindValue(':idSalarie', $heure->getSalarie()->getId());
        $sql->bindValue(':idTypeHeure', $heure->getTypeHeure()->getId());
        $sql->bindValue(':datetime', $heure->getDatetime()->format("Y-m-d H:i:s"));
        $sql->bindValue(':hr_ht_r', $heure->getHr_ht_r());
        
        $sql->execute();
    }
    
    public function delete(Heure $heure){
        $this->db->exec('
            DELETE FROM heure
            WHERE id = ' . $heure->getId()
        );
    }
    
    public function get($id){
        $saManager = new SalarieManager($this->db);
        $thManager = new TypeHeureManager($this->db);
        
        $sql = $this->db->query('SELECT * FROM heure WHERE valide = 1 AND id = '.$id);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        $data["datetime"] = new DateTime($data["datetime"]);        
        $data["salarie"] = $saManager->get($data["idSalarie"]);
        $data["typeHeure"] = $thManager->get($data["idTypeHeure"]);
        
        return new Heure($data);
    }
    
    public function getBySalarieDate(Salarie $salarie, DateTime $datetime, $hr_ht_r){
        $annee = $datetime->format("Y");
        $mois = $datetime->format("m");
        $jour = $datetime->format("d");
        
        $sql = $this->db->query("
            SELECT * 
            FROM heure 
            WHERE valide = 1
            AND idSalarie = ".$salarie->getId()."
            AND YEAR(datetime) = $annee
            AND MONTH(datetime) = $mois
            AND DAY(datetime) = $jour
            AND hr_ht_r = '$hr_ht_r'
        ");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($data)){
            $saManager = new SalarieManager($this->db);
            $thManager = new TypeHeureManager($this->db);
            
            $data["datetime"] = new DateTime($data["datetime"]);
            $data["salarie"] = $saManager->get($data["idSalarie"]);
            $data["typeHeure"] = $thManager->get($data["idTypeHeure"]);
            
            return new Heure($data);
        }
        else{
            return null;
        }
        
    }
    
    public function getList(){
        $list = []  ;
        
        $sql = $this->db->query('SELECT * FROM heure WHERE valide = 1 ORDER BY datetime ');
        
        $saManager = new SalarieManager($this->db);
        $thManager = new TypeHeureManager($this->db);
        
        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
            $data["datetime"] = new DateTime($data["datetime"]);
            $data["salarie"] = $saManager->get($data["idSalarie"]);
            $data["typeHeure"] = $thManager->get($data["idTypeHeure"]);
            
            $list[] = new Heure($data);
        }
        
        return $list;
    }    
}

?>