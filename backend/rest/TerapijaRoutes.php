<?php


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});

Flight::route('GET /terapija',function(){

    $dao = new ProjectDao();
    $terapija = $dao -> getAllTherapy();
    Flight::json($terapija);

});

Flight::route('GET /terapija/@id',function($id){

    $dao = new ProjectDao();
    $terapija_po_id = $dao -> getTherapyByID($id);
    Flight::json($terapija_po_id);

});

Flight::route('POST /terapija', function($data){

    $dao = new ProjectDao();
    $nova_terapija = $dao -> addTherapy($data);
    Flight::json($nova_terapija);
});

Flight::route('PUT /terapija/@id',function($id, $data){

    $dao = new ProjectDao();
    $izmjena = $dao -> updateTherapy($id, $data);
    Flight::json($izmjena);

});

Flight::route('DELETE /terapija/@id',function($id){

    $dao = new ProjectDao();
    $ukloni_terapiju = $dao -> deleteTherapy($id);
    Flight::json($ukloni_terapiju);

});

?>