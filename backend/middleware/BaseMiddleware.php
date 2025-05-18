<?php

namespace App\middleware;

use Flight;

class BaseMiddleware {
    
    public function checkRole($requiredRoles) {
        $user = Flight::get('user');
        
        if (!is_array($requiredRoles)) {
            $requiredRoles = [$requiredRoles];
        }
        
        if (!in_array($user->role, $requiredRoles)) {
            Flight::halt(403, 'Pristup odbijen: Nemate potrebnu ulogu za pristup ovoj ruti.');
        }
    }
    
    /*
    public function checkRole($requiredRole) {
        $user = Flight::get('user'); 

        if ($user->role !== $requiredRole) {
            Flight::halt(403, 'Pristup odbijen: Nemate potrebnu ulogu za pristup ovoj ruti.');
        }
    }
    */

    public function checkPermission($permission) {
        $user = Flight::get('user'); 

        if (!in_array($permission, $user->permissions)) {
            Flight::halt(403, 'Pristup odbijen: Nemate odgovarajuću dozvolu.');
        }
    }
}
