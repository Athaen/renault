<?php

require_once(classePath . "/report.php");

class ReportManager{
    private $db;
    
    public function __construct($db){
        $this->setDb($db);
    }
    
    public function setDb(PDO $db){
        $this->db= $db;
    }
    
    public function persist(Report $report){        
        if(!empty($report->getId())){
            $sql = $this->db->prepare('
                UPDATE report
                SET idSalarie = :idSalarie , datetime = :datetime, heure = :heure
                WHERE id = :id
            ');
        }
        else{
            $sql = $this->db->prepare('
                INSERT INTO report(id, idSalarie, datetime, heure)
                VALUES(:id, :idSalarie, :datetime, :heure)
            ');
        }
        
        $sql->bindValue(':id', $report->getId());
        $sql->bindValue(':idSalarie', $report->getSalarie()->getId());
        $sql->bindValue(':datetime', $report->getDatetime()->format("Y-m-d H:i:s"));
        $sql->bindValue(':heure', $report->getHeure());
        
        $sql->execute();
    }
    
    public function delete(Report $report){
        $this->db->exec('
            DELETE FROM report
            WHERE id = ' . $report->getId()
        );
    }
    
    public function get($id){
        $saManager = new SalarieManager($this->db);
        
        $sql = $this->db->query('SELECT * FROM report WHERE id = '.$id);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        $data["datetime"] = new DateTime($data["datetime"]);        
        $data["salarie"] = $saManager->get($data["idSalarie"]);
        unset($data["idSalarie"]);
        
        return new Report($data);
    }
    
    public function getBySalarieDate(Salarie $salarie, DateTime $datetime){
        $annee = $datetime->format("Y");
        
        $sql = $this->db->query("
            SELECT *
            FROM report
            WHERE idSalarie = ".$salarie->getId()."
            AND YEAR(datetime) = $annee
        ");
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        if(!empty($data)){
            $saManager = new SalarieManager($this->db);
            
            $data["datetime"] = new DateTime($data["datetime"]);
            $data["salarie"] = $saManager->get($data["idSalarie"]);
            
            return new Report($data);
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