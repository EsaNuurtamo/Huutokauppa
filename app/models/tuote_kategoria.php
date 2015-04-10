<?php
//liitostaulu tuotteen ja kategorioiden välillä
class TuoteKategoria extends BaseModel{
    public $id, $kategoria, $tuote;
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function tallenna(){
        $query = DB::connection()->prepare('INSERT INTO Tuotekategoria (kategoria, tuote) VALUES (:kategoria, :tuote) RETURNING id');
        $query->execute(array('kategoria' => $this->kategoria, 'tuote' => $this->tuote));
        $row = $query->fetch();
        
        
        
        $this->id = $row['id'];
    }
    
    public static function deleteByTuote($tuote){
        $query = DB::connection()->prepare('DELETE FROM Tuotekategoria WHERE tuote = :tuote');
        $query->execute(array('tuote' => $tuote));    
    }
    
    public static function  luoLiitokset($id, $kategoriat){
        
        if($kategoriat==null){return;}
        
        //tee liitostaulut
        foreach ($kategoriat as $kategoria){
            $tuoteKategoria=new TuoteKategoria(array(
                'kategoria' => $kategoria,
                'tuote' => ($id)
            ));
            $tuoteKategoria->tallenna();
        }
    }
    
    
    
    public static function poistaKategoriaIdlla($id){
        $query = DB::connection()->prepare('DELETE FROM Tuotekategoria WHERE kategoria = :id');
        $query->execute(array('id' => $id));
    }
    
    
}


