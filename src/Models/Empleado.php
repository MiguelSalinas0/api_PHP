<?php
namespace App\Models;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="empleado")
 */
class Empleado implements JsonSerializable
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
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="Venta", mappedBy="cliente", cascade={"all"})
     * @var Venta[] An ArrayCollection of Venta objects.
     */
    private $ventas;

    /**
     * @ORM\OneToOne(targetEntity="Persona", cascade={"persist", "remove"})
     * @var Persona
     */
    private $persona;

    public function __construct($data = [
        "email" => '',
        "password" => ''
    ])
    {
        $this->email = $data['email'];
        $this->password = $data['password'] ?? '123456';
        $this->ventas = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getVentas()
    {
        return $this->ventas;
    }

    public function addVenta(Venta $venta)
    {
        $this->ventas[] = $venta;
    }

    public function getPersona()
    {
        return $this->persona;
    }

    public function setPersona($persona)
    {
        $this->persona = $persona;
        $persona->setEmpleado($this);
    }

    public function jsonSerialize(): mixed
    {
        return [
            "id" => $this->id,
            "email" => $this->email,
            "password" => $this->password,
            "persona" => $this->persona->jsonSerialize(),
        ];
    }

    public function jsonSerialize2(): mixed
    {
        return [
            "id" => $this->id,
            "email" => $this->email,
            "password" => $this->password,
            "persona" => $this->persona->jsonSerialize(),
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
