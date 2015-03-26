<?php

class TuoteController extends BaseController{
    
//listaa kaikki tuotteet tuotteet.html sivulle
    public static function tuotteet(){
        $tuotteet = Tuote::all();
        //tähän korkeimman tarjouksen haku tietokannasta
        View::make('suunnitelmat/tuotteet.html', array('tuotteet' => $tuotteet));
    }
    public static function tuote_esittely($id){
        $tuote = Tuote::getById($id);
        $tarjoukset = Tarjous::getByTuote($id);
        $kategoriat = Kategoria::getByTuote($id);
        View::make('suunnitelmat/tuote_esittely.html',array('tuote' => $tuote, 'tarjoukset' => $tarjoukset, 'kategoriat' => $kategoriat));
    }
    public static function tuote_muokkaus($id){
        $tuote = Tuote::getById($id);
        View::make('suunnitelmat/tuote_muokkaus.html',array('tuote' => $tuote));
    }
    
    //luo uuden tuotteen ja ohjaa käyttäjän sen sivuille
    public static function luo_uusi(){
        $params = $_POST;
        /*$v = new Valitron\Validator($_POST);
        $v->rule('required', array('nimi','lisaysaika','kaupanAlku','kaupanLoppu'));
        if($v->validate()) {
            echo "Tuote lisätty!";
        } else {
            // Errors
            print_r($v->errors());
            return;
        }*/
        
        
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
        $tuote->tallenna();
        
        //tehdään liitostauluun rivit
        $kategoriat = $params['kategoriat'];
        
        foreach ($kategoriat as $kategoria){
            $tuoteKategoria=new TuoteKategoria(array(
                'kategoria' => $kategoria,
                'tuote' => ($tuote->id)
            ));
            $tuoteKategoria->tallenna();
        }
        

        //Redirect::to('/tuotteet/' . $tuote->id, array('viesti' => 'Uusi tuote on lisätty!'));
    }
    
    public static function tuote_uusi(){
        $kategoriat = Kategoria::all();
        View::make('suunnitelmat/tuote_uusi.html', array('kategoriat'=>$kategoriat));
    }
    
    public static function poista($id){
        
        Tuote::poista($id);
        Redirect::to('/tuotteet', array('viesti' => 'Tuote on poistettu onnistuneesti!'));
    }
    
    public static function kategorianTuotteet($id){
        $tuotteet = Tuote::getByKategoria($id);
        //tähän korkeimman tarjouksen haku tietokannasta
        View::make('suunnitelmat/tuotteet.html', array('tuotteet' => $tuotteet));
    }
            
}

