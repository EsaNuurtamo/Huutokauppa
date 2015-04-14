<?php

class Asiakas extends BaseModel{
    public $tunnus, $salasana, $nimi,$osoite,$sposti,$puhelin;
    public function __construct($attributes = null) {
        
        parent::__construct($attributes);
        
        
        $this->validations=array(
            'required' => array(
                array('tunnus'),array('salasana'),array('nimi'),array('osoite'),array('sposti')
            )
        );
        
    }
    
    //hakee kaikki tuotteet tietokannasta
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Asiakas ORDER BY nimi');
        $query->execute();
        $rows = $query->fetchAll();
        $tuotteet = array();

        foreach($rows as $row){
            $tuotteet[] = Asiakas::luoRivista($row);
        }

        return $tuotteet;
    }
    
    public static function findByTunnus($tunnus){
        $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $tunnus));
        $row = $query->fetch();

        return Asiakas::luoRivista($row);
    }
    
    public static function authenticate($tunnus, $salasana){
        $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
        $query->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
        $row = $query->fetch();
        if($row){
          return Asiakas::luoRivista($row);
        }else{
          return null;
        }
    }
    
    public static function luoRivista($row){
        if($row){
          $asiakas = new Asiakas(array(
            'tunnus' => $row['tunnus'],
            'salasana' => $row['salasana'],
            'nimi' => $row['nimi'],
            'osoite' => $row['osoite'],
            'sposti' => $row['sposti'],
            'puhelin' => $row['puhelin']
          ));

          return $asiakas;
        }
        return null;
        
    }
}

