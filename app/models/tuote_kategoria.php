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
    
    
}


