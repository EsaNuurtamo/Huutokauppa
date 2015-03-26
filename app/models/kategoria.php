<?php
class Kategoria extends BaseModel{
    public $id,$nimi,$kuvaus;
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    
    
    //hakee kaikki tuotteet tietokannasta
    public static function all(){
    
        $query = DB::connection()->prepare('SELECT * FROM Kategoria');
        $query->execute();
        $rows = $query->fetchAll();
        $kategoriat = array();

        foreach($rows as $row){
            $kategoriat[] = Kategoria::luoRivista($row);
        }
        

        return $kategoriat;
    }
    
    //tallenna tietokantaan
    public function tallenna(){
        $query = DB::connection()->prepare('INSERT INTO Kategoria (nimi, kuvaus) VALUES (:nimi, :kuvaus) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus));
        $row = $query->fetch();
        
        
        $this->id = $row['id'];
    }
    
    public static function luoRivista($row){
        if($row){
            return new Kategoria(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
            ));
        }
        return null;
    }
    
    
    
    public static function getByTuote($id){
        $query = DB::connection()->prepare('SELECT * FROM kategoria WHERE kategoria.id IN (SELECT tuotekategoria.kategoria FROM tuotekategoria WHERE tuotekategoria.tuote = :id)');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $kategoriat = array();

        foreach($rows as $row){
            $kategoriat[] = Kategoria::luoRivista($row);
        }
        

        return $kategoriat;
        
    }
    
    public static function poista($id){
        $query = DB::connection()->prepare('DELETE FROM Kategoria WHERE id = :id');
        $query->execute(array('id' => $id));
    }
}
