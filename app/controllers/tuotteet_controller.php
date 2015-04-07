<?php

class TuoteController extends BaseController{
    
//listaa kaikki tuotteet tuotteet.html sivulle
    public static function tuotteet(){
        $tuotteet = Tuote::all();
        $user = self::get_user();
        //tähän korkeimman tarjouksen haku tietokannasta
        View::make('suunnitelmat/tuotteet.html', array('tuotteet' => $tuotteet, 'user'=>$user));
    }
    public static function tuote_esittely($id){
        $tuote = Tuote::getById($id);
        $tarjoukset = Tarjous::getByTuote($id);
        $kategoriat = Kategoria::getByTuote($id);
        $user = self::get_user();
        View::make('suunnitelmat/tuote_esittely.html',array('tuote' => $tuote, 'tarjoukset' => $tarjoukset, 'kategoriat' => $kategoriat, 'user'=>$user));
    }
    public static function tuote_muokkaus($id){
        $tuote = Tuote::getById($id);
        $kategoriat = Kategoria::all();
        View::make('suunnitelmat/tuote_muokkaus.html',array('tuote' => $tuote, 'kategoriat' => $kategoriat));
    }
    
    public static function tee_muokkaus($id){
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
        $tuote->muokkaa($id);
        
        //tehdään liitostauluun rivit
        /*if(array_key_exists('kategoriat', $params)){
            $kategoriat = $params['kategoriat'];
            foreach ($kategoriat as $kategoria){
                $tuoteKategoria=new TuoteKategoria(array(
                    'kategoria' => $kategoria,
                    'tuote' => ($tuote->id)
                ));
                $tuoteKategoria->tallenna();
            }
        }*/
        
        Redirect::to('/tuotteet/' . $id, array('viesti' => 'Muokkaus onnistui!'));
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
        
        //parametrien validointi
        if($tuote->validate($params)){
            $tuote->tallenna();
        }else{
            //Kint::dump($tuote->errors());
            Redirect::to('/tuotteet/uusi', array('errors' => $tuote->errors()));
            return;
        }
        
        
        //tehdään liitostauluun rivit
        if(array_key_exists('kategoriat', $params)){
            
            $kategoriat = $params['kategoriat'];
            foreach ($kategoriat as $kategoria){
                $tuoteKategoria=new TuoteKategoria(array(
                    'kategoria' => $kategoria,
                    'tuote' => ($tuote->id)
                ));
                $tuoteKategoria->tallenna();
            }
        }
        
        Redirect::to('/tuotteet/' . $tuote->id, array('viesti' => 'Uusi tuote on lisätty!'));
    }
    
    public static function tuote_uusi(){
        $kategoriat = Kategoria::all();
        View::make('suunnitelmat/tuote_uusi.html', array('kategoriat'=>$kategoriat));
    }
    
    public static function poista($id){
        //poistetaan aluksi liitostaulun entryt
        //TuoteKategoria::poistaTuoteIdlla($id);
        Tuote::poista($id);
        Redirect::to('/tuotteet', array('viesti' => 'Tuote on poistettu onnistuneesti!'));
    }
    
    public static function kategorianTuotteet($id){
        $tuotteet = Tuote::getByKategoria($id);
        //tähän korkeimman tarjouksen haku tietokannasta
        View::make('suunnitelmat/tuotteet.html', array('tuotteet' => $tuotteet));
    }
            
}

