<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Peticiones
 *
 * @ORM\Table(name="peticiones")
 * @ORM\Entity
 */
class Peticiones
{
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
     * @ORM\Id
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="PASSWORD", type="string", length=100, nullable=false)
     */
    private $password;





    public function __construct(){
        
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
}
