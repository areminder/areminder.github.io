<?php

/**
 * Entidade de tarefas
 */

namespace VisaoIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="Tarefas")
 */

class Tarefas
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $data_finaliza;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $finalizada = 0;

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
     * @return Tarefas
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
     * @return Tarefas
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
     * @return mixed
     */
    public function isFinalizada()
    {
        return $this->finalizada;
    }

    /**
     * Set finalizada
     *
     * @param boolean $finalizada
     *
     * @return Tarefas
     */
    public function setFinalizada($finalizada)
    {
        $this->finalizada = $finalizada;

        return $this;
    }

    /**
     * Get finalizada
     *
     * @return boolean
     */
    public function getFinalizada()
    {
        return $this->finalizada;
    }
    /**
     * Set dataFinaliza
     *
     * @param \DateTime $dataFinaliza
     *
     * @return Tarefas
     */
    public function setDataFinaliza($dataFinaliza)
    {
        $this->data_finaliza = $dataFinaliza;

        return $this;
    }

    /**
     * Get dataFinaliza
     *
     * @return \DateTime
     */
    public function getDataFinaliza()
    {
        return $this->data_finaliza;
    }

    /**
    *  @ORM\ManyToOne(targetEntity="UsersBundle\Entity\Users")
    *  @ORM\JoinColumn(name="id_user", referencedColumnName="id", onDelete="CASCADE")
    */

    private $user;

    /**
     * Set user
     *
     * @param \UsersBundle\Entity\Users $user
     *
     * @return Tarefas
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
