<?php

class HeureTheorique{
    private
        $id,
        $salarie, // objet salarie
        $typeHeure, // objet typeHeure
        $datetime
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
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setSalarie(Salarie $salarie){
        $this->salarie = $salarie;
    }
    
    public function setTypeHeure($typeHeure){
        $this->typeHeure = $typeHeure;
    }
    
    public function setDatetime(DateTime $datetime){
        $this->datetime = $datetime;
    }
}

?>