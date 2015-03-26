<?php
class Tarjous extends BaseModel{
    public $id,$maara,$aika,$tuote,$asiakas;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function getByTuote($n){
    
        $query = DB::connection()->prepare('SELECT * FROM Tuote WHERE tuote = :n ORDER BY aika DESC');
        $query->execute(array('n' => $n));
        $rows = $query->fetchAll();
        
        $tarjoukset = array();
        foreach($rows as $row){
            $tarjoukset[] = new Tarjous(array(
                'id' => $row['id'],
                'maara' => $row['maara'],
                'aika' => $row['aika'],
                'tuote' => $row['tuote'],
                'asiakas' => $row['asiakas']
            ));
        }

        return $tarjoukset;
    }
    
    public function tallenna(){
        
        $query = DB::connection()->prepare('INSERT INTO Tarjous (maara, aika, tuote, asiakas) VALUES (:maara, :aika, :tuote, :asiakas) RETURNING id');
        $query->execute(array('maara' => $this->maara, 'aika' => $this->aika, 'tuote' => $this->tuote, 'asiakas' => $this->asiakas));
        $row = $query->fetch();
        
        Kint::trace();
        Kint::dump($row);
        
        $this->id = $row['id'];
        
    }
    
   
}

