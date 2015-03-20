<?php

class TuoteController extends BaseController{
    
//listaa kaikki tuotteet tuotteet.html sivulle
    public static function tuotteet(){
        $tuotteet = Tuote::all();
        View::make('suunnitelmat/tuotteet.html', array('tuotteet' => $tuotteet));
    }
    public static function tuote_esittely($id){
        $tuote = Tuote::getById($id);
        View::make('suunnitelmat/tuote_esittely.html',array('tuote' => $tuote));
    }
    public static function tuote_muokkaus($id){
        $tuote = Tuote::getById($id);
        View::make('suunnitelmat/tuote_muokkaus.html',array('tuote' => $tuote));
    }
    
    //luo uuden tuotteen ja ohjaa käyttäjän sen sivuille
    public static function luo_uusi(){
        $params = $_POST;
        $time=time();
        
        $tuote = new Tuote(array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'lisaysaika' => $time,
            'kaupanAlku' => $params['kaupanAlku'],
            'kaupanLoppu' => $params['kaupanLoppu'],
            'minimihinta' => $params['minimihinta'],
            'meklari' => $params['meklari']
          ));
        
        //Kint::dump($params);
        $tuote->tallenna();

        Redirect::to('/tuotteet/' . $tuote->id, array('viesti' => 'Uusi tuote on lisätty!'));
    }
    
    public static function tuote_uusi(){
        View::make('suunnitelmat/tuote_uusi.html');
    }
    
    public static function poista($id){
        $tuote = new Tuote(array('id' => $id));
        $tuote->poista($id);
        Redirect::to('/tuotteet', array('viesti' => 'Tuote on poistettu onnistuneesti!'));
    }
            
}

