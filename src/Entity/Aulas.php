<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Aulas
 *
 * @ORM\Table(name="aulas", indexes={@ORM\Index(name="PISO_FK", columns={"PISO"})})
 * @ORM\Entity
 */
class Aulas
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDAULA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idaula;

    /**
     * @var int
     *
     * @ORM\Column(name="PISO", type="integer", nullable=false)
     */
    private $piso;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=25, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=60, nullable=false)
     */
    private $descripcion;



    /**
     * Get the value of idaula
     *
     * @return  int
     */ 
    public function getIdaula()
    {
        return $this->idaula;
    }

    /**
     * Set the value of idaula
     *
     * @param  int  $idaula
     *
     * @return  self
     */ 
    public function setIdaula(int $idaula)
    {
        $this->idaula = $idaula;

        return $this;
    }

    /**
     * Get the value of piso
     *
     * @return  int
     */ 
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * Set the value of piso
     *
     * @param  int  $piso
     *
     * @return  self
     */ 
    public function setPiso(int $piso)
    {
        $this->piso = $piso;

        return $this;
    }

    /**
     * Get the value of tipo
     *
     * @return  string
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @param  string  $tipo
     *
     * @return  self
     */ 
    public function setTipo(string $tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of descripcion
     *
     * @return  string
     */ 
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @param  string  $descripcion
     *
     * @return  self
     */ 
    public function setDescripcion(string $descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}
