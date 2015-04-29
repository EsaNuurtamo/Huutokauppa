<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});



$routes->get('/poistu', function() {
    KirjautumisController::kirjaudu_ulos();
});

$routes->get('/kirjautuminen', function() {
    KirjautumisController::kirjautumissivu();
});

$routes->post('/kirjautuminen', function() {
    KirjautumisController::kirjaudu();
});

$routes->get('/rekisterointi', function() {
    KirjautumisController::rekisterointi();
});

$routes->post('/rekisterointi', function() {
    echo "ee";
    KirjautumisController::rekisteroi();
});

$routes->get('/profiili', function() {
    ProfiiliController::profiili();
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

$routes->get('/kategoriat/:id/muokkaa', function($id) {
    echo "routes";
    KategoriaController::kategoria_muokkaus($id);
});

$routes->post('/kategoriat/:id/muokkaa', function($id) {
    KategoriaController::tee_muokkaus($id);
});
$routes->post('/kategoriat/:id/poista', function($id) {
    KategoriaController::poista($id);
});







