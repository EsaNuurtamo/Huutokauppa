<?php

class TarjousController extends BaseController{
    
    
    public static function teeTarjous($id){
        $params = $_POST;
        
        $time=time();
        $tarjous = new Tarjous(array(
            'maara' => $params['maara'],
            'aika' => $time,
            'tuote' => $id,
            'asiakas' => 'Olli'
        ));
        Kint::dump($params);
        $tarjous ->tallenna();
        
        
        Redirect::to('/tuotteet/' . $id, array('viesti' => 'Uusi tarjous tehty!'));
    }
}

