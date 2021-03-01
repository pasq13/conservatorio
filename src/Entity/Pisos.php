<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Pisos
 *
 * @ORM\Table(name="pisos")
 * @ORM\Entity
 */
class Pisos
{
    /**
     * @var int
     *
     * @ORM\Column(name="IDPISO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idpiso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HORA", type="time", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $hora;


    /**
     * Get the value of idpiso
     *
     * @return  int
     */ 
    public function getIdpiso()
    {
        return $this->idpiso;
    }

    /**
     * Set the value of idpiso
     *
     * @param  int  $idpiso
     *
     * @return  self
     */ 
    public function setIdpiso(int $idpiso)
    {
        $this->idpiso = $idpiso;

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

}
