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
        $meklari = Meklari::findByTunnus($tuote->meklari);
        $user = self::get_user();
        View::make('suunnitelmat/tuote_esittely.html',array('tuote' => $tuote, 'tarjoukset' => $tarjoukset, 'kategoriat' => $kategoriat, 'user'=>$user, 'meklari'=>$meklari));
    }
    public static function tuote_muokkaus($id){
        $tuote = Tuote::getById($id);
        $kategoriat = Kategoria::all();
        $meklarit = Meklari::all();
        $tuotteenKategoriat= Kategoria::getByTuote($id);
        
        foreach($kategoriat as $kategoria){
            if(in_array($kategoria, $tuotteenKategoriat)){
                $kategoria->onTuotteen = true;
            }
        }
        
        View::make('suunnitelmat/tuote_muokkaus.html',array('tuote' => $tuote, 'kategoriat' => $kategoriat,'meklarit'=>$meklarit));
    }
    
    public static function tee_muokkaus($id){
        $params = $_POST;
        $kategoriat = Kategoria::all();
        $tuote = Tuote::luoParametreista($params);
        $meklarit = Meklari::all();
        
        //jos validi tallenna ja hoida liitokset kuntoon
        //jos virheitä renderöi uudelleen virheviestien kanssa
        if($tuote->validate($params)){
            TuoteKategoria::deleteByTuote($id);
            $tuote->muokkaa($id);
            if(array_key_exists('kategoriat', $params)){
                TuoteKategoria::luoLiitokset($id, $params['kategoriat']);
            }
            Redirect::to('/tuotteet/' . $tuote->id, array('viesti' => 'Muokkaus onnistui!'));
        }else{
            
            View::make('suunnitelmat/tuote_muokkaus.html',array('tuote' => $tuote,'errors' => $tuote->errors(), 'kategoriat' => $kategoriat,'meklarit'=>$meklarit));
        }
        
        
        
        //poista kaikki kategoriat liitostaulusta
        
        
        
        //Redirect::to('/tuotteet/' . $id, array('viesti' => 'Muokkaus onnistui!'));
    }
    
    //luo uuden tuotteen ja ohjaa käyttäjän sen sivuille
    public static function luo_uusi(){
        $params = $_POST;
        $kategoriat = Kategoria::all();
        $meklarit = Meklari::all();
        $tuote = Tuote::luoParametreista($params);
        
        //parametrien validointi
        if($tuote->validate($params)){
            $tuote->tallenna($params['kategoriat']);
            TuoteKategoria::luoLiitokset($tuote->id, $params['kategoriat']);
            Redirect::to('/tuotteet/' . $tuote->id, array('viesti' => 'Uusi tuote on lisätty!'));
        }else{
            View::make('suunnitelmat/tuote_uusi.html', array('errors' => $tuote->errors(),'kategoriat'=>$kategoriat,'meklarit'=>$meklarit, 'params' => $params));
        }
    }
    
    public static function tuote_uusi(){
        $kategoriat = Kategoria::all();
        $meklarit = Meklari::all();
        View::make('suunnitelmat/tuote_uusi.html', array('kategoriat'=>$kategoriat,'meklarit'=>$meklarit));
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

