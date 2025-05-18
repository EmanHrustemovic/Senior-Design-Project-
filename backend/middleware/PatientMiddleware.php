<?php

namespace App\middleware;

require_once __DIR__ . '/BaseMiddleware.php';

/*
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
*/
use Flight;
 
class PatientMiddleware extends BaseMiddleware{

    public function checkRole($requiredRole) {
        parent::checkRole('patient');
        /*
        $user = Flight::get('user'); 
        
        if ($user->role !== 'patient') {
            Flight::halt(403, 'Pristup odbijen: Samo pacijenti imaju pristup ovoj ruti.');
        }
        */
    }

    public function checkPermission($permission) {
        parent::checkPermission($permission);
        /*
        $user = Flight::get('user'); 

        if (!in_array($permission, $user->permissions)) {
            Flight::halt(403, 'Pristup odbijen: Nemate odgovarajuću dozvolu.');
        }
        */
    }

    /*

    public function authorizeRole($requiredRole){
        
        $patient = Flight::get('patient');

        if ($patient->role !== $requiredRole){

            Flight::halt(403,'Pristup odbijen : Samo doktori imaju ovakva ovlaštenja !');
        }
    }

    function authorizePermission($permission) {

        $patient = Flight::get('patient');
        
        if (!in_array($permission, $patient->permissions)) {
            
            Flight::halt(403, 'Pristup odbijen : Nemate profil kao pacijent na ovoj aplikaciji !');
        }
    }
    */
}