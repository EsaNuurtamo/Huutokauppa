<?php

class TuoteController extends BaseController{
    public static function tuotteet(){
        // Haetaan kaikki pelit tietokannasta
        $tuotteet = Tuote::getByName('Uuni');
        // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('suunnitelmat/tuotteet.html', array('tuotteet' => $tuotteet));
    }
}

