<?php


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});

Flight::route('GET /pregledi',function(){

    $dao = new ProjectDao();
    $checks = $dao ->getAllChecks();
    Flight::json($checks);
});

Flight::route('GET /pregledi/@id',function($id){

    $dao = new ProjectDao();
    $checks_per_id = $dao ->preglediPoID($id);
    Flight::json($checks_per_id);
});

Flight::route('POST /pregledi/@id',function($data){

    $dao = new ProjectDao();
    $add_check = $dao ->dodajPregled($data);
    Flight::json($add_check);
});

Flight::route('POST /pregledi/@id',function($id,$data){

    $dao = new ProjectDao();
    $update_check = $dao ->izmjeniPregled($id, $data);
    Flight::json($update_check);
});


Flight::route('DELETE /pregledi/@id',function($id){

    $dao = new ProjectDao();
    $delete_check = $dao ->obrišiPregled($id);
    Flight::json($delete_check);
});


?>