<?php

/**
 * Entidade de notas
 */

namespace VisaoIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="Notas")
 */

class Notas
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
    protected $descricao;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $data_criacao;
    
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
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Notas
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set dataCriacao
     *
     * @param \DateTime $dataCriacao
     *
     * @return Notas
     */
    public function setDataCriacao($dataCriacao)
    {
        $this->data_criacao = $dataCriacao;

        return $this;
    }

    /**
     * Get dataCriacao
     *
     * @return \DateTime
     */
    public function getDataCriacao()
    {
        return $this->data_criacao;
    }

    /**
     * Set user
     *
     * @param \UsersBundle\Entity\Users $user
     *
     * @return Notas
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
