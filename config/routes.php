<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/kirjautuminen', function() {
    HelloWorldController::kirjautuminen();
});

$routes->post('/tuotteet', function(){
    TuoteController::luo_uusi();
});

$routes->get('/tuotteet', function() {
    TuoteController::tuotteet();
});



$routes->get('/tuotteet/uusi', function(){
    TuoteController::tuote_uusi();
});

$routes->get('/tuotteet/:id', function($id){
    TuoteController::tuote_esittely($id);
});

$routes->post('/tuotteet/:id/poista', function($id) {
    TuoteController::poista($id);
});

$routes->get('/tuotteet/:id/muokkaa', function($id) {
    TuoteController::tuote_muokkaus($id);
});

$routes->get('/tuotteet/:id/tarjoukset', function($id) {
    TarjousController::tuotteenTarjoukset();
});

$routes->post('/tuotteet/:id/tarjoa', function($id) {
    TarjousController::teeTarjous($id);
});
