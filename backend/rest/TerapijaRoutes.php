<?php

use App\dao\TerapijaDao;
use App\services\terapijaService;


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});

Flight::route('GET /therapy',function(){

    $dao = new TerapijaDao();
    $terapija = $dao -> getAllTherapy();
    Flight::json($terapija);
//RADI , H1
});

Flight::route('GET /therapy/@id',function($id){

    $dao = new TerapijaDao();
    $terapija_po_id = $dao -> getTherapyByID($id);
    Flight::json($terapija_po_id);

    //RADI , H1

});

Flight::route('POST /therapy/add', function(){

    $data = Flight::request()->data;

    //$id = $data -> id;
    $terapija_id = $data -> terapija_id;
    $vrsta = $data -> vrsta;
    $doza_i_uputa = $data -> doza_i_uputa;
    $trajanje = $data -> trajanje;
    $kontrola = $data -> kontorla;
    $doktor_id = $data -> doktor_id;
    $pregledi_id = $data -> pregledi_id;


    $service = new terapijaService();
    $nova_terapija = $service -> addTherapy($terapija_id,$vrsta,$doza_i_uputa,$trajanje,$kontrola,$doktor_id, $pregledi_id);

    Flight::json($nova_terapija);

    //NE RADI
});

Flight::route('PUT /therapy/@id',function($id){

    $data = Flight::request()->data;

    $service = new terapijaService();
    $izmjena = $service -> updateTherapy($id, $data);

    Flight::json($izmjena);

    //NE RADI

});

Flight::route('DELETE /therapy/@id',function($id){

    $service = new terapijaService();

    $ukloni_terapiju = $service -> deleteTherapy($id);
    Flight::json($ukloni_terapiju);

    // NE RADI

});
