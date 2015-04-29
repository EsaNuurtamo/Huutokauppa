<?php

class KirjautumisController extends BaseController{
    public static function kirjautumissivu(){
        View::make('suunnitelmat/kirjautuminen.html');
    }
    public static function kirjaudu(){
        $params = $_POST;

        $kayttaja = null;
        $asiakas = Asiakas::authenticate($params['tunnus'], $params['salasana']);
        $meklari = Meklari::authenticate($params['tunnus'], $params['salasana']);
        
        if($asiakas != null){
            $kayttaja=$asiakas;
        }else if($meklari !=null){
            $kayttaja=$meklari;
        }
        if(!$kayttaja){
          View::make('suunnitelmat/kirjautuminen.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'tunnus' => $params['tunnus']));
        }else{
          $_SESSION['user'] = $kayttaja->tunnus;
          Redirect::to('/tuotteet', array('viesti' => 'Tervetuloa takaisin ' . $kayttaja->tunnus . '!'));
        }
       
    }
    public static function kirjaudu_ulos(){
        $_SESSION['user'] = null;
        Redirect::to('/kirjautuminen', array('viesti' => 'Olet kirjautunut ulos!'));
    }
    
    public static function rekisterointi(){
        View::make('suunnitelmat/rekisterointi.html');
        
    }
    
    public static function rekisteroi(){
        
        $params = $_POST;
        $asiakas = new Asiakas(array(
            'tunnus' => $params['tunnus'],
            'salasana' => $params['salasana'],
            'nimi' => $params['nimi'],
            'osoite' => $params['osoite'],
            'sposti' => $params['sposti'],
            'puhelin' => $params['puhelin'],
            'vahvistus' => $params['vahvistus']
        ));
        
        //parametrien validointi
        if($asiakas->validate($params)){
            $asiakas->tallenna($params);
            Redirect::to('/kirjautuminen', array('viesti' => 'Profiili luotu! Kirjaudu sisään'));
        }else{
            View::make('suunnitelmat/rekisterointi.html', array('errors' => $asiakas->errors(),'params' => $params));
        }
        
    }
}

