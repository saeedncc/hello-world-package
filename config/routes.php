<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static  function (RoutingConfigurator $routes): void {
    $routes->add('home', '/')
        ->controller(['App\Controller\HomeController', 'index'])
        ->methods(['GET'])
    ;
	
	
	$routes->add('api.drivers.index', '/api/drivers')
        ->controller(['App\Controller\DriverController', 'index'])
        ->methods(['GET'])
    ;
	
	
	$routes->add('api.trucks.index', '/api/trucks')
        ->controller(['App\Controller\TruckController', 'index'])
        ->methods(['GET'])
    ;
	
	
	$routes->add('api.tasks.index', '/api/tasks')
        ->controller(['App\Controller\TaskController', 'index'])
        ->methods(['GET'])
    ;
	
	
	$routes->add('api.tasks.assign', '/api/tasks/{id}/assign')
        ->controller(['App\Controller\TaskController', 'assign'])
        ->methods(['PUT'])
    ;
	
	
	$routes->add('api.trips.index', '/api/trips')
        ->controller(['App\Controller\TripController', 'index'])
        ->methods(['GET'])
    ;
	
	
	$routes->add('api.trips.store', '/api/trips')
        ->controller(['App\Controller\TripController', 'store'])
        ->methods(['POST'])
    ;

	
	
};