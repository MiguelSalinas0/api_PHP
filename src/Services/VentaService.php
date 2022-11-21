<?php

namespace App\Services;

use App\Models\Venta;

class ventaService
{
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAll()
    {
        $ventas = $this->entityManager->getRepository(Venta::class)->findAll();
        return $ventas;
    }

    public function findById($id)
    {
        $venta = $this->entityManager->getRepository(Venta::class)->findOneBy(['id' => $id]);
        return $venta;
    }

    public function getVentasDia(string $fecha)
    {
        $time = strtotime($fecha);
        $f1 = new \DateTime(date("Y-m-d", $time));
        $f2 = new \DateTime(date("Y-m-d", $time));
        $from = $f1->format("Y-m-d") . " 00:00:00";
        $to = $f2->format("Y-m-d") . " 23:59:59";
        $venta = $this->entityManager->getRepository(Venta::class);
        $qb = $venta->createQueryBuilder('v');
        $qb
            ->andWhere('v.fecha BETWEEN :from AND :to')
            ->setParameter('from', $from)
            ->setParameter('to', $to);
        $result = $qb->getQuery()->getResult();
        return $result;
    }
}
