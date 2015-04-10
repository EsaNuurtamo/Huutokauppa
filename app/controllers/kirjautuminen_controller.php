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
}

