<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        View::make('home.html');
    }

    public static function sandbox(){
        View::make('helloworld.html');
    }
    
    public static function kirjautuminen(){
        View::make('suunnitelmat/kirjautuminen.html');
    }
    
    public static function tuotteet(){
        View::make('suunnitelmat/tuotteet.html');
    }
    public static function tuote_esittely(){
        View::make('suunnitelmat/tuote_esittely.html');
    }
  }
