<?php

require_once(classePath . "/heureTheorique.php");

class heureTheoriqueManager{
    private $db;
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->db= $db;
    }
    
    public function add(HeureTheorique $heureTheorique){
        $sql = $this->db->prepare('
            INSERT INTO heuretheorique(id, idSalarie, idTypeHeure, datetime) 
            VALUES(:id, :idSalarie, :idTypeHeure, :datetime)
        ');
        
        $sql->bindValue(':id', $heureTheorique->getId());
        $sql->bindValue(':idSalarie', $heureTheorique->getSalarie()->getId());
        $sql->bindValue(':idTypeHeure', $heureTheorique->getTypeHeure()->getId());
        $sql->bindValue(':datetime', $heureTheorique->getDatetime()->format("Y-m-d H:i:s"));
        
        $sql->execute();
    }
    
    public function update(HeureTheorique $heureTheorique){
        $sql = $this->db->prepare('
            UPDATE heuretheorique
            SET idSalarie = :idSalarie, idTypeHeure = :idTypeHeure, datetime = :datetime
            WHERE id = :id
        ');
        
        $sql->bindValue(':idSalarie', $heureTheorique->getSalarie()->getId());
        $sql->bindValue(':idTypeHeure', $heureTheorique->getTypeHeure()->getId());
        $sql->bindValue(':datetime', $heureTheorique->getDatetime());
        $sql->bindValue(':id', $heureTheorique->getId());
        
        $sql->execute();
    }
    
    public function delete(HeureTheorique $heureTheorique){
        $this->db->exec('
            UPDATE heuretheorique
            SET valide = 0
            WHERE id = ' . $heureTheorique->getId()
        );
    }
    
    public function get($id){
        $sql = $this->db->query('SELECT * FROM heuretheorique WHERE valide = 1 AND id = '.$id);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        $data["datetime"] = new DateTime($data["datetime"]);
        
        return new HeureTheorique($data);
    }
    
    public function getBySalarieDate(Salarie $salarie, DateTime $datetime){
        $annee = $datetime->format("Y");
        $mois = $datetime->format("m");
        $jour = $datetime->format("d");
        
        $sql = $this->db->query("
            SELECT * 
            FROM heuretheorique 
            WHERE valide = 1
            AND idSalarie = ".$salarie->getId()."
            AND YEAR(datetime) = $annee
            AND MONTH(datetime) = $mois
            AND DAY(datetime) = $jour
        ");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($data)){
            $data["datetime"] = new DateTime($data["datetime"]);
            
            return new HeureTheorique($data);
        }
        else{
            return null;
        }
        
    }
    
    public function getList(){
        $list = [];
        
        $sql = $this->db->query('SELECT * FROM heuretheorique WHERE valide = 1 ORDER BY datetime ');
        
        while ($data = $sql->fetch(PDO::FETCH_ASSOC)){
            $data["datetime"] = new DateTime($data["datetime"]);
            $list[] = new HeureTheorique($data);
        }
        
        return $list;
    }
}

?>