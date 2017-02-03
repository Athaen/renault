<?php

class Report{
    private
        $id,
        $salarie, // objet salarie
        $datetime, // objet DateTime
        $heure
    ;
    
    public function __construct($data){
        $this->hydrate($data);
    }
    
    public function hydrate(array $data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
    
    public function getId(){ return $this->id; }
    public function getSalarie(){ return $this->salarie; }
    public function getDatetime(){ return $this->datetime; }
    public function getHeure(){ return $this->heure; }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setSalarie(Salarie $salarie){
        $this->salarie = $salarie;
    }
    
    public function setDatetime(DateTime $datetime){
        $this->datetime = $datetime;
    }
    
    public function setHeure($heure){
        $this->heure = $heure;
    }
}

?>