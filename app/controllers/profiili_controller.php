<?php
class ProfiiliController extends BaseController{
    
    public static function profiili(){
        $user = self::get_user();
        $tuotteet = Tuote::getByMeklari($user->tunnus);
        View::make('suunnitelmat/profiili.html', array('user'=>$user, 'tuotteet'=>$tuotteet));
    }
}

