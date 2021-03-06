<?php

class Salarie{
    private
        $id,
        $service, // objet service
        $autorisations, // collection d'objets autorisation
        $nom,
        $prenom,
        $mdp
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
    public function getService(){ return $this->service; }
    public function getAutorisations(){ return $this->autorisations; }
    public function getNom(){ return $this->nom; }
    public function getPrenom(){ return $this->prenom; }
    public function getMdp(){ return $this->mdp; }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function setService(Service $service){
        $this->service = $service;
    }
    
    public function setAutorisations($autorisations){
        $this->autorisations = $autorisations;
    }
    
    public function setNom($nom){
        $this->nom = $nom;
    }
    
    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }
    
    public function setMdp($mdp){
        $this->mdp = $mdp;
    }
}

?>