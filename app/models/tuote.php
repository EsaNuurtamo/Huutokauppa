<?php

class Tuote extends BaseModel{
    public $id, $nimi, $kuvaus, $lisaysaika, $kaupanAlku, $kaupanLoppu, $minimihinta, $meklari;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    
    //hakee kaikki tuotteet tietokannasta
    public static function all(){
    
        $query = DB::connection()->prepare('SELECT * FROM Tuote');
        $query->execute();
        $rows = $query->fetchAll();
        $tuotteet = array();

        foreach($rows as $row){
            $tuotteet[] = new Tuote(array(
              'id' => $row['id'],
              'nimi' => $row['nimi'],
              'kuvaus' => $row['kuvaus'],
              'lisaysaika' => $row['lisaysaika'],
              'kaupanAlku' => $row['kaupanalku'],
              'kaupanLoppu' => $row['kaupanloppu'],
              'minimihinta' => $row['minimihinta'],
              'meklari' => $row['meklari']

            ));
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
          $tuotteet[] = new Tuote(array(
            'id' => $row['id'],
            'nimi' => $row['nimi'],
            'kuvaus' => $row['kuvaus'],
            'lisaysaika' => $row['lisaysaika'],
            'kaupanAlku' => $row['kaupanalku'],
            'kaupanLoppu' => $row['kaupanloppu'],
            'minimihinta' => $row['minimihinta'],
            'meklari' => $row['meklari']
            
          ));
        }

        return $tuotteet;
    }
    
    //hakee tietyn ID:n omaavan tuotteen
    public static function getById($id){
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if($row){
          $tuote = new Tuote(array(
            'id' => $row['id'],
            'nimi' => $row['nimi'],
            'kuvaus' => $row['kuvaus'],
            'lisaysaika' => $row['lisaysaika'],
            'kaupanAlku' => $row['kaupanalku'],
            'kaupanLoppu' => $row['kaupanloppu'],
            'minimihinta' => $row['minimihinta'],
            'meklari' => $row['meklari']
          ));

          return $tuote;
        }

        return null;
    }
    
    //tallentaa olion tietokantaan
    public function tallenna(){
        
        $query = DB::connection()->prepare('INSERT INTO Tuote (nimi, kuvaus, lisaysaika, kaupanAlku, kaupanLoppu, minimihinta, meklari) VALUES (:nimi, :kuvaus, NOW(), :kaupanalku, :kaupanloppu, :minimihinta, :meklari) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'kaupanalku' => $this->kaupanAlku, 'kaupanloppu' => $this->kaupanLoppu, 'minimihinta' => $this->minimihinta, 'meklari' => $this->meklari));
        $row = $query->fetch();
        
        //Kint::trace();
        //Kint::dump($row);
        
        $this->id = $row['id'];
        
    }
    
    public static function poista($id){
        $query = DB::connection()->prepare('DELETE FROM Tuote WHERE id = :id');
        $query->execute(array('id' => $id));
        //Kint::trace();
        
    }
}

