<?php


Flight::route('GET /connection-check' ,function(){
    
    $projectService = Flight::projectService();
    
    echo $projectService -> connStatus;

});

Flight::route('GET /zdravstveniKarton',function(){

    $dao = new ProjectDao();
    $card = $dao -> izlistajKarton();
    Flight::json($card);

});

Flight::route('GET /zdravstveniKarton/@id',function($id){

    $dao = new ProjectDao();
    $card_by_id = $dao -> kartoniPoID($id);
    Flight::json($card_by_id);

});

Flight::route('POST /zdravstveniKarton', function($data){

    $dao = new ProjectDao();
    $novi_karton = $dao -> dodajKarton($data);
    Flight::json($novi_karton);
});

Flight::route('PUT /zdravstveniKarton/@id',function($id, $data){

    $dao = new ProjectDao();
    $izmjeni_karton = $dao -> izmjeniKarton($id, $data);
    Flight::json($izmjeni_karton);

});

Flight::route('DELETE /zdravstveniKarton/@id',function($id){

    $dao = new ProjectDao();
    $ukloni_karton = $dao -> obrišiKarton($id);
    Flight::json($ukloni_karton);

});

?>