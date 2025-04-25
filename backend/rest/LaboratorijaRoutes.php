<?php


require_once __DIR__ . '/../dao/LaboratorijaDao.php';
require_once __DIR__ . '/../services/laboratorijaService.php';

use App\dao\LaboratorijaDao;
use App\services\laboratorijaService;

Flight::route('GET /connection-check' ,function(){
    
    /*
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;
    */

});

Flight::route('GET /labs',function(){

    $dao = new LaboratorijaDao();
    $laboratorija = $dao->pregledLaboratorije();

    Flight::json($laboratorija);

    //RADI

});

Flight::route('GET /labs/@id',function($id){

    $dao = new LaboratorijaDao();
    $lab = $dao -> laboratorijaPoId($id);
    Flight::json($lab);
//RADI
});

Flight::route('POST /labs/add', function() {
    $data = Flight::request()->data;

    $sifraNalaza = $data->sifraNalaza;
    $tipNalaza = $data->tipNalaza;
    $vrsta_uzorka = $data->vrsta_uzorka;
    $datum_obrade = $data->datum_obrade;
    $status = $data->status;
    $pregledi_id = $data->pregledi_id;

    $service = new laboratorijaService();
    $new_lab = $service->addLaboratory($sifraNalaza, $tipNalaza, $vrsta_uzorka, $datum_obrade, $status, $pregledi_id);

    Flight::json(["success" => true]);

    //RADI
});


Flight::route('PUT /labs/@id', function($id) {

    $data = Flight::request()->data;
    //var_dump(Flight::request()->data);

    $service = new laboratorijaService();
    $update_lab = $service->updateLaboratory($id, $data);

    Flight::json($update_lab);

    //RADI
});


Flight::route('DELETE /labs/@id',function($id){

    // RADI

    $message = "";

    $service = new laboratorijaService();

    $delete_lab = $service-> deleteLaboratory($id);

    if ($delete_lab) {
        $message =  "Laboratorijski podatci su uspješno izbrisani iz baze.";
    } else {
        $message = "Laboratorijski podatci nisu uspješno izbrisani iz baze.";
    }
    print($message);

    //RADI
});
