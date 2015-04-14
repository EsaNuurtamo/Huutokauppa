<?php

class Meklari extends BaseModel{
    public $tunnus, $salasana, $nimi,$admin,$sposti,$puhelin,$onMeklari;
    public function __construct($attributes = null) {
        
        parent::__construct($attributes);
        $this->validations=array(
            'required' => array(
                array('tunnus'),array('salasana'),array('nimi'),array('osoite'),array('sposti')
            )
        );
        
        $this->onMeklari=true;
        
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Meklari ORDER BY nimi');
        $query->execute();
        $rows = $query->fetchAll();
        $tuotteet = array();

        foreach($rows as $row){
            $tuotteet[] = Meklari::luoRivista($row);
        }

        return $tuotteet;
    }
    
    public static function findByTunnus($tunnus){
        $query = DB::connection()->prepare('SELECT * FROM Meklari WHERE tunnus = :tunnus');
        $query->execute(array('tunnus' => $tunnus));
        $row = $query->fetch();

        return Meklari::luoRivista($row);
    }
    
    public static function authenticate($tunnus, $salasana){
        $query = DB::connection()->prepare('SELECT * FROM Meklari WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');
        $query->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
        $row = $query->fetch();
        if($row){
          return Meklari::luoRivista($row);
        }else{
          return null;
        }
    }
    
    public static function luoRivista($row){
        if($row){
          $meklari = new Meklari(array(
            'tunnus' => $row['tunnus'],
            'salasana' => $row['salasana'],
            'nimi' => $row['nimi'],
            'sposti' => $row['sposti'],
            'puhelin' => $row['puhelin'],
            'admin' => $row['admin']
          ));
          
          return $meklari;
        }
        return null;
        
    }
}

