<?php 

$routes = [
    'login' => [
        'path' => '/',
        'controller' => 'LoginController',
        'method' => 'index'
    ],
    'logout' => [
        'path' => '/logout',
        'controller' => 'LoginController',
        'method' => 'logout'
    ],
    'register' => [
        'path' => '/register',
        'controller' => 'LoginController',
        'method' => 'register'
    ],
    'forget' => [
        'path' => '/forget',
        'controller' => 'LoginController',
        'method' => 'forget'
    ],
    'addacount' => [
        'path' => '/addacount',
        'controller' => 'LoginController',
        'method' => 'addacount'
    ],
    'checkCredentials' => [
        'path' => '/checkCredentials',
        'controller' => 'LoginController',
        'method' => 'checkCredentials'
    ],
    'home' => [
        'path' => '/home',
        'controller' => 'LoginController',
        'method' => 'home'
    ],
    'listEmployes' => [
        'path' => '/Liste_Employes',
        'controller' => 'LoginController',
        'method' => 'listEmployes'
    ],
    'GetEmployerById' => [
        'path' => '/GetEmployerById',
        'controller' => 'LoginController',
        'method' => 'GetEmployerById'
    ],
    'MAJEmploye' => [
        'path' => '/MAJEmploye',
        'controller' => 'LoginController',
        'method' => 'MAJEmploye'
    ],
    'DeleteEmploye' => [
        'path' => '/DeleteEmploye',
        'controller' => 'LoginController',
        'method' => 'DeleteEmploye'
    ],
    'AddEmploye' => [
        'path' => '/AddEmploye',
        'controller' => 'LoginController',
        'method' => 'AddEmploye'
    ],
    'UpdateSettings' => [
        'path' => '/UpdateSettings',
        'controller' => 'LoginController',
        'method' => 'UpdateSettings'
    ],
    'DemandeConge' => [
        'path' => '/DemandeConge',
        'controller' => 'DemandeController',
        'method' => 'index'
    ],
    'AddDemande' => [
        'path' => '/AddDemande',
        'controller' => 'DemandeController',
        'method' => 'AddDemande'
    ],
    'GetDemandeNonValdide' => [
        'path'=>'/GetDemandeNonValdide',
        'controller'=>'DemandeController',
        'method'=>'GetDemandeNonValdide'
    ],
    'ValidateConge' => [
        'path'=>'/ValidateConge',
        'controller'=>'DemandeController',
        'method'=>'ValidateConge'
    ],
    'DeleteDemande' => [
        'path' => '/DeleteDemande',
        'controller' => 'DemandeController',
        'method' => 'DeleteDemande'
    ],
    'UpdateDemande' => [
        'path' => '/UpdateDemande',
        'controller' => 'DemandeController',
        'method' => 'UpdateDemande'
    ],
    'GetDemandeById' => [
        'path'=>'/GetDemandeById',
        'controller'=>'DemandeController',
        'method'=>'GetDemandeById'
    ]

];

return $routes;