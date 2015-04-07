<?php
class KategoriaController extends BaseController{
    public static function kategoriat(){
        $kategoriat=Kategoria::all();
        $user = self::get_user();
        View::make('suunnitelmat/kategoriat.html', array('kategoriat' => $kategoriat, 'user'=>$user));
    }
    
    public static function luo_uusi(){
        $params = $_POST;
        
        $kategoria = new Kategoria(array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus']
        ));
        
        $kategoria->tallenna();

        Redirect::to('/kategoriat', array('viesti' => 'Uusi kategoria on lisätty!'));
    }
    
    public static function kategoria_uusi(){
        View::make('suunnitelmat/kategoria_uusi.html');
    }
    
    public static function poista($id){
        //poistetaan aluksi liitostaulun entryt
        //TuoteKategoria::poistaKategoriaIdlla($id);
        Kategoria::poista($id);
        Redirect::to('/kategoriat', array('viesti' => 'Kategoria poistettu onnistuneesti!'));
    }
}


