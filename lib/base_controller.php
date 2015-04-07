<?php

  class BaseController{

    public static function get_user(){
        // Katsotaan onko user-avain sessiossa
        if(isset($_SESSION['user'])){
          $tunnus = $_SESSION['user'];
          // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
          $asiakas = Asiakas::findByTunnus($tunnus);
          $meklari = Meklari::findByTunnus($tunnus);
          
          if($asiakas!=null){
              return $asiakas;
          }else if($meklari!=null){
              return $meklari;
          }
          
          
        }

        // Käyttäjä ei ole kirjautunut sisään
        return null;
    }

    

  }
