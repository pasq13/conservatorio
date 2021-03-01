<?php



use Doctrine\ORM\Mapping as ORM;
// use \JsonSerializable;
/**
 * Reservas
 *
 * @ORM\Table(name="reservas", indexes={@ORM\Index(name="RESERVAS_FK", columns={"IDALUMNO"}), @ORM\Index(name="RESERVAS_FK2", columns={"IDAULA"})})
 * @ORM\Entity
 */
class Reservas implements JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDRESERVA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreserva;

    /**
     * @var int
     *
     * @ORM\Column(name="IDALUMNO", type="integer", nullable=false)
     */
    private $idalumno;

    /**
     * @var int
     *
     * @ORM\Column(name="IDAULA", type="integer", nullable=false)
     */
    private $idaula;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HORA", type="time", nullable=false)
     */
    private $hora;



    /**
     * Get the value of idreserva
     *
     * @return  int
     */ 
    public function getIdreserva()
    {
        return $this->idreserva;
    }

    /**
     * Set the value of idreserva
     *
     * @param  int  $idreserva
     *
     * @return  self
     */ 
    public function setIdreserva(int $idreserva)
    {
        $this->idreserva = $idreserva;

        return $this;
    }

    /**
     * Get the value of idalumno
     *
     * @return  int
     */ 
    public function getIdalumno()
    {
        return $this->idalumno;
    }

    /**
     * Set the value of idalumno
     *
     * @param  int  $idalumno
     *
     * @return  self
     */ 
    public function setIdalumno(int $idalumno)
    {
        $this->idalumno = $idalumno;

        return $this;
    }

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
     * Get the value of fecha
     *
     * @return  \DateTime
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @param  \DateTime  $fecha
     *
     * @return  self
     */ 
    public function setFecha(\DateTime $fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of hora
     *
     * @return  \DateTime
     */ 
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @param  \DateTime  $hora
     *
     * @return  self
     */ 
    public function setHora(\DateTime $hora)
    {
        $this->hora = $hora;

        return $this;
    }
    public function jsonSerialize(){
        return array("idaula"=>$this->getIdaula(),"fecha"=>$this->getFecha(),"hora"=>$this->getHora());
    }
}
