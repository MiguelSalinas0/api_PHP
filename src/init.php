<?php

require_once "bootstrap.php";

use App\Models\Persona;

use App\Services\clienteService;
use App\Services\empleadoService;
use App\Services\ventaService;

if (!isset($entityManager)) {
    echo "Entity manager is not set.\n";
    return;
}

$clienteService = new clienteService($entityManager);
$empleadoService = new empleadoService($entityManager);
$ventaService = new ventaService($entityManager);

// $cl = new Cliente($data = [
//     "dni" => '41701066'
// ]);

// $em = new Empleado($data = [
//     "email" => 'coreofalso@gmial.com',
//     "password" => 'contra'
// ]);

// $per1 = new Persona($data = [
//     "nombre" => 'Jorge',
//     "apellido" => 'Algo'
// ]);

// $per2 = new Persona($data = [
//     "nombre" => 'nmober2',
//     "apellido" => 'apeloid2'
// ]);

// $vent1 = new Venta($data = [
//     "importe" => 250.00,
//     "fecha" => new DateTime()
// ]);

// $vent1->setCliente($cl);
// $vent1->setEmpleado($em);


// $cl->setPersona($per1);
// $em->setPersona($per2);

// $cl->addVenta($vent1);
// $em->addVenta($vent1);

// $entityManager->persist($cl);
// $entityManager->persist($em);
// $entityManager->persist($vent1);

// $entityManager->flush();

// $clienteService->create($data = [
//     "dni" => '418008',
//     "persona" => [
//         "nombre" => 'Jose',
//         "apellido" => 'Peña'
//     ]
// ]);

// $cliente = $clienteService->findByDni('41701066');

// echo $cliente;

// $ventas = $cliente->getVentas();

// foreach ($ventas as $vent) {
//     //echo json_encode($vent);
//     echo $vent->getImporte() . ' ' . $vent->getFecha()->format('Y-m-d H:i:s') . ' ' . json_encode($vent->getEmpleado());
// }
// $em = $empleadoService->findById(1);
// echo json_encode($em);



// $em = $ventaService->getVentas(2);
// echo json_encode($em);
// foreach ($em as $key) {
//     echo $key->getImporte();
// }

//echo json_encode($ventaService->getVentasDia('2022/10/19'), JSON_PRETTY_PRINT);
