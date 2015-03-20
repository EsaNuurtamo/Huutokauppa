<?php

class Tuote extends BaseModel{
    public $id, $nimi, $kuvaus, $lisaysaika, $kaupanAlku, $kaupanLoppu, $minimihinta, $meklari;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
    // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Tuote');
        // Suoritetaan kysely
        $query->execute();
        
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $tuotteet = array();

        // Käydään kyselyn tuottamat rivit läpi
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
    
    public static function getByName($n){
    // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE nimi = :n');
        // Suoritetaan kysely
        $query->execute(array('n' => $n));
        
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $tuotteet = array();

        // Käydään kyselyn tuottamat rivit läpi
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
}

