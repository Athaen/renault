<?php

require_once(classePath . "/heureReel.php");

class heureReelManager{
    private $db;
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->db= $db;
    }
    
    public function add(HeureReel $heureReel){
        $sql = $this->db->prepare('
            INSERT INTO heurereel(id, idSalarie, idTypeHeure, datetime) 
            VALUES(:id, :idSalarie, :idTypeHeure, :datetime)
        ');
        
        $sql->bindValue(':id', $heureReel->getId());
        $sql->bindValue(':idSalarie', $heureReel->getSalarie()->getId());
        $sql->bindValue(':idTypeHeure', $heureReel->getTypeHeure()->getId());
        $sql->bindValue(':datetime', $heureReel->getDatetime());
        
        $sql->execute();
    }
    
    public function update(HeureReel $heureReel){
        $sql = $this->db->prepare('
            UPDATE heurereel
            SET idSalarie = :idSalarie, idTypeHeure = :idTypeHeure, datetime = :datetime
            WHERE id = :id
        ');
        
        $sql->bindValue(':idSalarie', $heureReel->getSalarie()->getId());
        $sql->bindValue(':idTypeHeure', $heureReel->getTypeHeure()->getId());
        $sql->bindValue(':datetime', $heureReel->getDatetime());
        $sql->bindValue(':id', $heureReel->getId());
        
        $sql->execute();
    }
    
    public function delete(HeureReel $heureReel){
        $this->db->exec('
            UPDATE heurereel
            SET valide = 0
            WHERE id = ' . $heureReel->getId()
        );
    }
    
    public function get($id){
        $sql = $this->db->query('SELECT * FROM heurereel WHERE valide = 1 AND id = '.$id);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        $data["datetime"] = new DateTime($data["datetime"]);
        
        return new HeureReel($data);
    }
    
    public function getBySalarieDate(Salarie $salarie, DateTime $datetime){
        $annee = $datetime->format("Y");
        $mois = $datetime->format("m");
        $jour = $datetime->format("d");
        
        $sql = $this->db->query("
            SELECT * 
            FROM heurereel 
            WHERE valide = 1
            AND idSalarie = ".$salarie->getId()."
            AND YEAR(datetime) = $annee
            AND MONTH(datetime) = $mois
            AND DAY(datetime) = $jour
        ");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($data)){
            $data["datetime"] = new DateTime($data["datetime"]);
            
            return new HeureReel($data);
        }
        else{
            return null;
        }
        
    }
    
    public function getList(){
        $list = [];
        
        $sql = $this->db->query('SELECT * FROM heurereel WHERE valide = 1 ORDER BY datetime ');
        
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)){
            $data["datetime"] = new DateTime($data["datetime"]);
            $list[] = new HeureReel($data);
        }
        
        return $list;
    }
}

?>