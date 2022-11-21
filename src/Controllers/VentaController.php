<?php

namespace App\Controllers;

use App\Services\ventaService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class VentaController
{
    private $app;
    private $ventaService;
    private $entityManager;

    public function __construct($app, $entityManager)
    {
        $this->app = $app;
        $this->entityManager = $entityManager;
        $this->ventaService = new ventaService($entityManager);
    }

    public function buildRoutes()
    {
        $this->app->get('/venta/{id}', [$this, 'getOneId']);
        $this->app->get('/ventas', [$this, 'getAll']);
        $this->app->get('/ventas/dia', [$this, 'getOneDay']);
    }

    function getOneId(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $venta = json_encode($this->ventaService->findById($id), JSON_PRETTY_PRINT);
        $response->getBody()->write($venta);
        return $response;
    }

    function getOneDay(Request $request, Response $response, $args)
    {
        $dia = $request->getHeader('dia');
        $venta = json_encode($this->ventaService->getVentasDia($dia[0]), JSON_PRETTY_PRINT);
        $response->getBody()->write($venta);
        return $response;
    }

    function getAll(Request $request, Response $response, $args)
    {
        $ventas = json_encode($this->ventaService->getAll(), JSON_PRETTY_PRINT);
        $response->getBody()->write($ventas);
        return $response;
    }
}
