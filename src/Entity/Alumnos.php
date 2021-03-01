<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Alumnos
 *
 * @ORM\Table(name="alumnos", uniqueConstraints={@ORM\UniqueConstraint(name="UN_CORREO", columns={"CORREO"})}, indexes={@ORM\Index(name="NOMBREADMIN_FK", columns={"NOMBREADMIN"})})
 * @ORM\Entity
 */
class Alumnos
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
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=30, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="APELLIDOS", type="string", length=60, nullable=false)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="INSTRUMENTO", type="string", length=15, nullable=false)
     */
    private $instrumento;

    /**
     * @var string
     *
     * @ORM\Column(name="CORREO", type="string", length=90, nullable=false)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="PASSWORD", type="string", length=100, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBREADMIN", type="string", length=30, nullable=false)
     */
    private $nombreadmin;



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
     * Get the value of nombre
     *
     * @return  string
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @param  string  $nombre
     *
     * @return  self
     */ 
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellidos
     *
     * @return  string
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set the value of apellidos
     *
     * @param  string  $apellidos
     *
     * @return  self
     */ 
    public function setApellidos(string $apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get the value of instrumento
     *
     * @return  string
     */ 
    public function getInstrumento()
    {
        return $this->instrumento;
    }

    /**
     * Set the value of instrumento
     *
     * @param  string  $instrumento
     *
     * @return  self
     */ 
    public function setInstrumento(string $instrumento)
    {
        $this->instrumento = $instrumento;

        return $this;
    }

    /**
     * Get the value of correo
     *
     * @return  string
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @param  string  $correo
     *
     * @return  self
     */ 
    public function setCorreo(string $correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of nombreadmin
     *
     * @return  string
     */ 
    public function getNombreadmin()
    {
        return $this->nombreadmin;
    }

    /**
     * Set the value of nombreadmin
     *
     * @param  string  $nombreadmin
     *
     * @return  self
     */ 
    public function setNombreadmin(string $nombreadmin)
    {
        $this->nombreadmin = $nombreadmin;

        return $this;
    }
}
