<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Persona;

class clienteService
{

    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create($data)
    {
        $cliente = $this->exists($data['dni']);
        if ($cliente) {
            return $cliente;
        }
        $cliente = new Cliente($data['dni']);
        $persona = new Persona($data['nombre'], $data['apellido']);
        $cliente->setPersona($persona);
        $this->entityManager->persist($cliente);
        $this->entityManager->flush();
        return $cliente;
    }

    public function update($dni, $data)
    {
        $response = [];
        $cliente = $this->exists($dni);
        if (!$cliente) {
            $response['success'] = false;
            $response['message'] = 'Client ' . $dni . ' not found.';
            return $response;
        } else {
            $cliente->setDni($data['dni']);
            $persona = $cliente->getPersona();
            $persona->setNombre($data['nombre']);
            $persona->setApellido($data['apellido']);
            $this->entityManager->flush();
            $response['success'] = true;
            $response['message'] = 'Client updated successfully';
            $response['data'] = $cliente;
            return $response;
        }
    }

    public function allClient()
    {
        $clientes = $this->entityManager->getRepository(Cliente::class)->findAll();
        return $clientes;
    }

    public function delete($clientDni)
    {
        $response = [];
        $Client = $this->exists($clientDni);
        if (!$Client) {
            $response['success'] = false;
            $response['message'] = 'Client ' . $clientDni . ' not found.';
            return $response;
        }
        $this->entityManager->remove($Client);
        $this->entityManager->flush();
        $response = [
            'success' => true,
            'message' => 'Client deleted successfully',
            'data' => [
                'dni' => $clientDni
            ]
        ];
        return $response;
    }

    public function findByDni($dni)
    {
        $response = [];
        $cliente = $this->exists($dni);
        if (!$cliente) {
            $response['success'] = false;
            $response['message'] = 'Client ' . $dni . ' not found.';
            return $response;
        } else {
            $response = [
                'success' => true,
                'message' => 'Client find successfully',
                'data' => $cliente
            ];
            return $response;
        }
    }

    public function exists($dni)
    {
        $cliente = $this->entityManager->getRepository(Cliente::class)->findOneBy(['dni' => $dni]);
        return $cliente;
    }

    public function getVentas($dni)
    {
        $cliente = $this->exists($dni);
        return $cliente->jsonSerialize2();
    }
}
