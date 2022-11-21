<?php
namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="cliente")
 */
class Cliente implements JsonSerializable
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
    private $dni;

    /**
     * @ORM\OneToOne(targetEntity="Persona", inversedBy="cliente", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Persona
     */
    private $persona;

    /**
     * @ORM\OneToMany(targetEntity="Venta", mappedBy="cliente", cascade={"all"})
     * @var Venta[] An ArrayCollection of Venta objects.
     */
    private $ventas;

    public function __construct($dni)
    {
        $this->dni = $dni;
        $this->ventas = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function getPersona()
    {
        return $this->persona;
    }

    public function setPersona($persona)
    {
        $this->persona = $persona;
        $persona->setCliente($this);
    }

    public function getVentas()
    {
        return $this->ventas;
    }

    public function addVenta(Venta $venta)
    {
        $this->ventas[] = $venta;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'dni' => $this->dni,
            'persona' => $this->persona->jsonSerialize(),
        ];
    }

    public function jsonSerialize2(): mixed
    {
        return [
            'id' => $this->id,
            'dni' => $this->dni,
            'persona' => $this->persona->jsonSerialize(),
            'ventas' => $this->traeVentas(),
        ];
    }

    private function traeVentas()
    {
        $_ventas = [];
        foreach ($this->getVentas() as $venta) {
            $_ventas[] = $venta;
        }
        return $_ventas;
    }
}
