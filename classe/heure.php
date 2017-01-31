<?php

class Heure{
    private
        $id,
        $salarie, // objet salarie
        $typeHeure, // objet typeHeure
        $datetime,
        $hr_ht_r
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
    public function getTypeHeure(){ return $this->typeHeure; }
    public function getDatetime(){ return $this->datetime; }
    public function getHr_ht_r(){ return $this->hr_ht_r; }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setSalarie(Salarie $salarie){
        $this->salarie = $salarie;
    }
    
    public function setTypeHeure(TypeHeure $typeHeure){
        $this->typeHeure = $typeHeure;
    }
    
    public function setDatetime(DateTime $datetime){
        $this->datetime = $datetime;
    }
    
    public function setHr_ht_r($hr_ht_r){
        $this->hr_ht_r = $hr_ht_r;
    }
}

?>