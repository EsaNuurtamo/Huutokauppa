<?php
class Tarjous extends BaseModel{
    public $id,$maara,$aika,$tuote,$asiakas;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    //hae tietokannasta kaikki tietylle tuotteelle tehdyt tarjoukset
    public static function getByTuote($id){
        $query = DB::connection()->prepare('SELECT * FROM Tarjous WHERE tuote = :id ORDER BY aika DESC');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        
        $tarjoukset = array();
        foreach($rows as $row){
            $tarjoukset[] = Tarjous::luoRivista($row);
        }
        //Kint::dump($tarjoukset);

        return $tarjoukset;
    }
    
    //tallenna tietokantaan
    public function tallenna(){
        $query = DB::connection()->prepare('INSERT INTO Tarjous (maara, aika, tuote, asiakas) VALUES (:maara, NOW(), :tuote, :asiakas) RETURNING id');
        $query->execute(array('maara' => $this->maara, 'tuote' => $this->tuote, 'asiakas' => $this->asiakas));
        $row = $query->fetch();
        //Kint::trace();
        //Kint::dump($row);
        
        $this->id = $row['id'];
    }
    
    //luodaan Tarjous-olio tietokannan rivistä
    public static function luoRivista($row){
        if($row){
            return new Tarjous(array(
                'id' => $row['id'],
                'maara' => $row['maara'],
                'aika' => date("Y-m-d H:i:s",  strtotime($row['aika'])),
                'tuote' => $row['tuote'],
                'asiakas' => $row['asiakas']
            ));
        }
        return null;
    }
    
   
}

