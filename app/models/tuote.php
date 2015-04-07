<?php

class Tuote extends BaseModel{
    public $id, $nimi, $kuvaus, $lisaysaika, $kaupanAlku, $kaupanLoppu, $minimihinta, $meklari;
    
    public function __construct($attributes){
        
        
        parent::__construct($attributes);
        
        $this->validations = array(
            'required' => array(
                array('nimi'),array('kaupanAlku'),array('kaupanLoppu')
            ),
            'date' => array(
                array('lisaysaika'),array('kaupanAlku'),array('kaupanLoppu')
            ),
            
            'lengthMax' => array(
                array('kuvaus',500)
            )
        );
        
    }
    
    //public function initValidationRules
    
    
    //hakee kaikki tuotteet tietokannasta
    public static function all(){
        
        $query = DB::connection()->prepare('SELECT * FROM Tuote ORDER BY nimi');
        $query->execute();
        $rows = $query->fetchAll();
        $tuotteet = array();

        foreach($rows as $row){
            $tuotteet[] = Tuote::luoRivista($row);
        }

        return $tuotteet;
    }
    
    //hakee tietyn nimen omaavia tuotteita 
    public static function getByName($n){
    
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE nimi = :n');
        $query->execute(array('n' => $n));
        $rows = $query->fetchAll();
        
        $tuotteet = array();
        foreach($rows as $row){
          $tuotteet[] = Tuote::luoRivista($row);
        }

        return $tuotteet;
    }
    
    
    
    //hakee tietyn ID:n omaavan tuotteen
    public static function getById($id){
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        return Tuote::luoRivista($row);
    }
    //TESTAAMATTA
    public static function getByKategoria($id){
        $query = DB::connection()->prepare('SELECT * FROM tuote WHERE tuote.id IN (SELECT tuotekategoria.tuote FROM tuotekategoria WHERE tuotekategoria.kategoria = :id )');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $tuotteet = array();

        foreach($rows as $row){
            $tuotteet[] = Tuote::luoRivista($row);
        }

        return $tuotteet;
    }
    
    //tallentaa olion tietokantaan
    public function tallenna(){
        
        $query = DB::connection()->prepare('INSERT INTO Tuote (nimi, kuvaus, lisaysaika, kaupanAlku, kaupanLoppu, minimihinta, meklari) VALUES (:nimi, :kuvaus, NOW(), :kaupanalku, :kaupanloppu, :minimihinta, :meklari) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'kaupanalku' => $this->kaupanAlku, 'kaupanloppu' => $this->kaupanLoppu, 'minimihinta' => $this->minimihinta, 'meklari' => $this->meklari));
        $row = $query->fetch();
        
        
        
        $this->id = $row['id'];
        
    }
    
    public function muokkaa($id){
        
        $query = DB::connection()->prepare('UPDATE Tuote SET nimi = :nimi, kuvaus = :kuvaus, kaupanalku = :kaupanalku, kaupanloppu = :kaupanloppu, minimihinta = :minimihinta, meklari = :meklari WHERE id = :id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'kaupanalku' => $this->kaupanAlku, 'kaupanloppu' => $this->kaupanLoppu, 'minimihinta' => $this->minimihinta, 'meklari' => $this->meklari, 'id' => $id));
    }
    
    public static function poista($id){
        $query = DB::connection()->prepare('DELETE FROM Tuote WHERE id = :id');
        $query->execute(array('id' => $id));
    }
    
    public static function luoRivista($row){
        if($row){
          $tuote = new Tuote(array(
            'id' => $row['id'],
            'nimi' => $row['nimi'],
            'kuvaus' => $row['kuvaus'],
            'lisaysaika' => date("Y-m-d H:i:s",  strtotime($row['lisaysaika'])),
            'kaupanAlku' => $row['kaupanalku'],
            'kaupanLoppu' => $row['kaupanloppu'],
            'minimihinta' => $row['minimihinta'],
            'meklari' => $row['meklari']
          ));

          return $tuote;
        }
        return null;
        
    }
            
}

