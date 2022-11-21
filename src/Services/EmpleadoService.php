<?php

namespace App\Services;

use App\Models\Empleado;

class empleadoService
{

    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findByEmail($email)
    {
        $empleado = $this->entityManager->getRepository(Empleado::class)->findOneBy(['email' => $email]);
        return $empleado;
    }

    public function findById($id)
    {
        $empleado = $this->entityManager->getRepository(Empleado::class)->findOneBy(['id' => $id]);
        return $empleado;
    }

    public function allEmpleado()
    {
        $empleados = $this->entityManager->getRepository(Empleado::class)->findAll();
        return $empleados;
    }

    public function getVentas($id)
    {
        $empleado = $this->findById($id);
        return $empleado->jsonSerialize2();
    }
}
