<?php

namespace App\Controllers;

use App\Services\empleadoService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class EmpleadoController
{
    private $app;
    private $empleadoService;
    private $entityManager;

    public function __construct($app, $entityManager)
    {
        $this->app = $app;
        $this->entityManager = $entityManager;
        $this->empleadoService = new empleadoService($entityManager);
    }

    public function buildRoutes()
    {
        $this->app->get('/empleado/{id}', [$this, 'getOne']);
        $this->app->get('/empleados', [$this, 'getAll']);
        $this->app->get('/empleado/ventas/{id}', [$this, 'getVentas']);
    }

    function getOne(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $empleado = json_encode($this->empleadoService->findById($id), JSON_PRETTY_PRINT);
        $response->getBody()->write($empleado);
        return $response;
    }

    function getAll(Request $request, Response $response, $args)
    {
        $empleados = json_encode($this->empleadoService->allEmpleado(), JSON_PRETTY_PRINT);
        $response->getBody()->write($empleados);
        return $response;
    }

    function getVentas(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $empleadoVentas = json_encode($this->empleadoService->getVentas($id), JSON_PRETTY_PRINT);
        $response->getBody()->write($empleadoVentas);
        return $response;
    }
}
