<?php

class TarjousController extends BaseController{
    public static function tuotteenTarjoukset($id){
        $tarjoukset = Tarjous::getByTuote($id);
    }
    
    public static function teeTarjous($id){
        $params = $_POST;
        
        $time=time();
        $tarjous = new Tarjous(array(
            'maara' => $params['maara'],
            'aika' => $time,
            'tuote' => $id,
            'asiakas' => 'Olli'
        ));
        
        $tarjous ->tallenna();
    }
}

