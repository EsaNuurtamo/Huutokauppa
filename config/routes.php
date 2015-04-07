<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/kirjautuminen', function() {
    LoginController::kirjautumissivu();
});

$routes->post('/kirjautuminen', function() {
    LoginController::kirjaudu();
});

$routes->post('/tuotteet', function(){
    TuoteController::luo_uusi();
});

$routes->get('/tuotteet', function() {
    TuoteController::tuotteet();
});

$routes->get('/tuotteet/kategoria/:id', function($id) {
    TuoteController::kategorianTuotteet($id);
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

$routes->post('/tuotteet/:id/muokkaa', function($id) {
    TuoteController::tee_muokkaus($id);
});

$routes->post('/tuotteet/:id/tarjoa', function($id) {
    TarjousController::teeTarjous($id);
});



$routes->post('/kategoriat', function(){
    KategoriaController::luo_uusi();
});

$routes->get('/kategoriat', function() {
    KategoriaController::kategoriat();
});
$routes->get('/kategoriat/uusi', function(){
    KategoriaController::kategoria_uusi();
});
$routes->post('/kategoriat/:id/poista', function($id) {
    KategoriaController::poista($id);
});





