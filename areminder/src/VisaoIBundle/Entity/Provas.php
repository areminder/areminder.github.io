<?php

/**
 * Entidade de notas
 */

namespace VisaoIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="Provas")
 */

class Provas
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="text")
     */
    protected $materia;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $data_prova;
    
    /**
    *  @ORM\ManyToOne(targetEntity="UsersBundle\Entity\Users")
    *  @ORM\JoinColumn(name="id_user", referencedColumnName="id", onDelete="CASCADE")
    */

    private $user;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set materia
     *
     * @param string $materia
     *
     * @return Provas
     */
    public function setMateria($materia)
    {
        $this->materia = $materia;

        return $this;
    }

    /**
     * Get materia
     *
     * @return string
     */
    public function getMateria()
    {
        return $this->materia;
    }

    /**
     * Set dataProva
     *
     * @param \DateTime $dataProva
     *
     * @return Provas
     */
    public function setDataProva($dataProva)
    {
        $this->data_prova = $dataProva;

        return $this;
    }

    /**
     * Get dataProva
     *
     * @return \DateTime
     */
    public function getDataProva()
    {
        return $this->data_prova;
    }

    /**
     * Set user
     *
     * @param \UsersBundle\Entity\Users $user
     *
     * @return Provas
     */
    public function setUser(\UsersBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UsersBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }
}
