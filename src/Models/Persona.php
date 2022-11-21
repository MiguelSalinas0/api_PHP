<?php

namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="persona")
 */
class Persona implements JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $nombre;

    /**
     * @ORM\Column(type="string")
     */
    private $apellido;

    /**
     * @ORM\OneToOne(targetEntity="Empleado", inversedBy="persona", cascade={"remove"})
     * @ORM\JoinColumn(name="empleado_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Empleado
     */
    private $empleado;

    /**
     * @ORM\OneToOne(targetEntity="Cliente", inversedBy="persona", cascade={"remove"})
     * @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Cliente
     */
    private $cliente;

    public function __construct($nombre, $apellido)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getEmpleado()
    {
        return $this->empleado;
    }

    public function setEmpleado(Empleado $empleado)
    {
        $this->empleado = $empleado;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function jsonSerialize(): mixed
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
        ];
    }
}
