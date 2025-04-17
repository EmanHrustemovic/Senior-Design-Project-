<?php

use App\dao\ZdravstveniKartonDao;
use App\services\kartonServices;
use App\services\zdravstveniKartonService;


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});

Flight::route('GET /cards', function(){

    $dao = new ZdravstveniKartonDao();
    $card = $dao->izlistajKarton();

    Flight::json($card);

//RADI , ALI DAJE H1 I NE DAJE SVE PARAMETRE
});

Flight::route('GET /cards/@id',function($id){

    $dao = new ZdravstveniKartonDao();

    $card_by_id = $dao->kartoniPoID($id);
    Flight::json($card_by_id);

    //RADI , ALI DAJE H1 I NE DAJE SVE PARAMETRE
});

Flight::route('POST /cards/add', function(){

    $data = Flight::request()->data;

    $id = $data->id;
    $sifraBolesti = $data->sifraBolesti;
    $nazivBolesti = $data->nazivBolesti;
    $dijagnoza = $data -> dijagnoza;
    $terapija = $data -> terapija;
    $pacijent_id = $data -> pacijent_id;
    $pregledi_id = $data -> pregledi_id;
    $doktor_id = $data -> doktor_id;

    $service = new zdravstveniKartonService();

    $novi_karton = $service->dodajKarton($id,$sifraBolesti,$nazivBolesti,$dijagnoza,$terapija,$pacijent_id,$pregledi_id,$doktor_id);
    Flight::json($novi_karton);

    Flight::json(['message' => 'Novi karton je uspješno dodat.']);

    //NE RADI
});

Flight::route('PUT /cards/@id',function($id){

    $data = Flight::request()->data;

    $service = new zdravstveniKartonService();
    $izmjeni_karton = $service -> izmjeniKarton($id,$data);

    Flight::json($izmjeni_karton);
//NE RADI
});

Flight::route('DELETE /cards/@id',function($id){

    $service = new zdravstveniKartonService();

    $ukloni_karton = $service -> obrisiKarton($id);
    Flight::json($ukloni_karton);
//NE RADI
});

