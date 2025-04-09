<?php


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});

Flight::route('GET /laboratorija',function(){

    $dao = new ProjectDao();
    $laboratorija = $dao -> pregledLaboratorije();
    Flight::json($laboratorija);

});

Flight::route('GET /laboratorija/@id',function($id){

    $dao = new ProjectDao();
    $lab = $dao -> laboratorijaPoId($id);
    Flight::json($lab);

});

Flight::route('POST /laboratorija/@data',function($data){

    $dao = new ProjectDao();
    $new_lab = $dao -> addLaboratory($data);
    Flight::json($new_lab);

});

Flight::route('UPDATE /laboratorija/@data',function($id,$data){

    $dao = new ProjectDao();
    $update_lab = $dao -> updateLaboratory($id, $data);
    Flight::json($update_lab);

});

Flight::routee('DELETE /laboratorija/',function($id){

    $dao = new ProjectDao();
    $ukloni_laboratoriju = $dao -> deleteLaboratory($id);
    Flight::json($ukloni_laboratoriju);

});

?>