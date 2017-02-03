<?php

require_once(classePath . "/arretHt.php");

class ArretHtManager{
    private $db;
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->db= $db;
    }
    
    public function persist(ArretHt $arretHt){        
        if(!empty($arretHt->getId())){
            $sql = $this->db->prepare('
                UPDATE arretht
                SET datetime = :datetime, heure = :heure
                WHERE id = :id
            ');
        }
        else{
            $sql = $this->db->prepare('
                INSERT INTO arretht(id, datetime, heure) 
                VALUES(:id, :datetime, :heure)
            ');
        }
        
        $sql->bindValue(':id', $arretHt->getId());
        $sql->bindValue(':datetime', $arretHt->getDatetime()->format("Y-m-d H:i:s"));
        $sql->bindValue(':heure', $arretHt->getHeure());
        
        $sql->execute();
    }
    
    public function delete(ArretHt $arretHt){
        $this->db->exec('
            DELETE FROM arretHt
            WHERE id = ' . $arretHt->getId()
        );
    }
    
    public function get($id){
        $sql = $this->db->query('SELECT * FROM arretHt WHERE id = '.$id);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        $data["datetime"] = new DateTime($data["datetime"]);
        
        return new ArretHt($data);
    }
    
    public function getByDate(DateTime $datetime){
        $annee = $datetime->format("Y");
        $mois = $datetime->format("m");
        
        $sql = $this->db->query("
            SELECT *
            FROM arretHt
            WHERE MONTH(datetime) = $mois
            AND YEAR(datetime) = $annee
        ");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($data)){            
            $data["datetime"] = new DateTime($data["datetime"]);
            
            return new ArretHt($data);
        }
        else{
            return null;
        }
        
    }
    
    public function getList(){
        $list = []  ;
        
        $sql = $this->db->query('SELECT * FROM arretHt ORDER BY datetime ');
        
        while($data = $sql->fetch(PDO::FETCH_ASSOC)){
            $data["datetime"] = new DateTime($data["datetime"]);
            
            $list[] = new ArretHt($data);
        }
        
        return $list;
    }    
}

?>