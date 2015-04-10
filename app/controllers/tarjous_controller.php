<?php

class TarjousController extends BaseController{
    
    
    public static function teeTarjous($id){
        $params = $_POST;
        $korkein=Tarjous::getTuotteenKorkein($id);
        
        
        $time=time();
        $tarjous = new Tarjous(array(
            'maara' => $params['maara'],
            'aika' => $time,
            'tuote' => $id,
            'asiakas' => 'Olli'
        ));
        
        if($korkein<$tarjous->maara){
            $tarjous ->tallenna();
            Redirect::to('/tuotteet/' . $id, array('viesti' => 'Uusi tarjous tehty!'));
        }else{
            
            Redirect::to('/tuotteet/' . $id, array('errors'=>'Liian pieni tarjous'));
        }
            
        
        
        
        
    }
}

