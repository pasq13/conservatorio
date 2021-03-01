<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Administrador
 *
 * @ORM\Table(name="administrador", uniqueConstraints={@ORM\UniqueConstraint(name="NOMBRE", columns={"NOMBRE"})})
 * @ORM\Entity
 */
class Administrador
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NOMBRE", type="string", length=30, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PASSWORD", type="string", length=100, nullable=true)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ADMIN", type="string", length=15, nullable=true)
     */
    private $admin;






 /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string|null
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string|null  $password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of nombre
     *
     * @return  string|null
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @param  string|null  $nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of admin
     *
     * @return  string|null
     */ 
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Set the value of admin
     *
     * @param  string|null  $admin
     *
     * @return  self
     */ 
    public function setAdmin($admin)
    {
        $this->admin = $admin;

        return $this;
    }

}
