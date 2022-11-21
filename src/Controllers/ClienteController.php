<?php

namespace App\Controllers;

use App\Services\clienteService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ClienteController
{
    private $app;
    private $clienteService;
    private $entityManager;

    public function __construct($app, $entityManager)
    {
        $this->app = $app;
        $this->entityManager = $entityManager;
        $this->clienteService = new clienteService($entityManager);
    }

    public function buildRoutes()
    {
        $this->app->get('/cliente/{dni}', [$this, 'getOne']);
        $this->app->get('/clientes', [$this, 'getAll']);
        $this->app->get('/cliente/ventas/{dni}', [$this, 'getVentas']);
        $this->app->post('/cliente/create', [$this, 'create']);
        $this->app->put('/cliente/update/{dni}', [$this, 'update']);
        $this->app->delete('/cliente/delete/{dni}', [$this, 'delete']);
    }

    function getOne(Request $request, Response $response, $args)
    {
        $dni = $args['dni'];
        $cliente = json_encode($this->clienteService->findByDni($dni), JSON_PRETTY_PRINT);
        $response->getBody()->write($cliente);
        return $response;
    }

    function getAll(Request $request, Response $response, $args)
    {
        $clientes = json_encode($this->clienteService->allClient(), JSON_PRETTY_PRINT);
        $response->getBody()->write($clientes);
        return $response;
    }

    function getVentas(Request $request, Response $response, $args)
    {
        $dni = $args['dni'];
        $clienteVentas = json_encode($this->clienteService->getVentas($dni), JSON_PRETTY_PRINT);
        $response->getBody()->write($clienteVentas);
        return $response;
    }

    function create(Request $request, Response $response, $args)
    {
        $data = json_decode($request->getBody(), true);
        $NuevoCliente = json_encode($this->clienteService->create($data), JSON_PRETTY_PRINT);
        $response->getBody()->write($NuevoCliente);
        return $response;
    }

    function update(Request $request, Response $response, $args)
    {
        $clientDni = $args['dni'];
        $json = $request->getBody();
        $data = json_decode($json, true);
        $cliente = json_encode($this->clienteService->update($clientDni, $data), JSON_PRETTY_PRINT);
        $response->getBody()->write($cliente);
        return $response;
    }

    function delete(Request $request, Response $response, $args)
    {
        $clientDni = $args['dni'];
        $client = json_encode($this->clienteService->delete($clientDni), JSON_PRETTY_PRINT);
        $response->getBody()->write($client);
        return $response;
    }
}
