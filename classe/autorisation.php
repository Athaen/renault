<?php

class Autorisation{
    private
        $id,
        $libelle
    ;
    
    public function __construct($donnees){
        $this->hydrate($donnees);
    }
    
    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value){
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)){
                $this->$method($value);
            }
        }
    }
    
    public function getId(){ return $this->id; }
    public function getLibelle(){ return $this->libelle; }
    
    public function setId($id){
        $this->id = $id;
    }
        
    public function setLibelle($libelle){
        $this->libelle = $libelle;
    }
}

?>