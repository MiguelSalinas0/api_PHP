<?php
namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="venta")
 */
class Venta implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $importe;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Cliente", inversedBy="venta")
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", nullable=false)
     * @var Cliente
     */
    private $cliente;

    /**
     * @ORM\ManyToOne(targetEntity="Empleado", inversedBy="venta")
     * @ORM\JoinColumn(name="empleado_id", referencedColumnName="id", nullable=false)
     * @var Empleado
     */
    private $empleado;

    public function __construct($data = [
        "importe" => 0.0,
        "fecha" => ''
    ])
    {
        $this->importe = $data['importe'];
        $this->fecha = $data['fecha'];
    }

    public function getId()
    {
        return $this->id;
    }

    public function getImporte()
    {
        return $this->importe;
    }

    public function setImporte($importe)
    {
        $this->importe = $importe;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setCliente(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setEmpleado(Empleado $empleado)
    {
        $this->empleado = $empleado;
    }

    public function getEmpleado()
    {
        return $this->empleado;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "id" => $this->id,
            "importe" => $this->importe,
            "fecha" => $this->fecha,
            "empleado" => $this->empleado->jsonSerialize(),
            "cliente" => $this->cliente->jsonSerialize()
        ];
    }
}
