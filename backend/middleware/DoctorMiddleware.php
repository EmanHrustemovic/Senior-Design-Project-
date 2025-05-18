<?php

namespace App\middleware;

require_once __DIR__ . '/BaseMiddleware.php';
/*use Firebase\JWT\JWT;
use Firebase\JWT\Key;
*/
use Flight;

class DoctorMiddleware extends BaseMiddleware{
    public function checkRole($requiredRole) {
         parent::checkRole('doctor');
        
         /*
        $user = Flight::get('user'); 
        
        if ($user->role !== 'doctor') {
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
        }*/
    }

}