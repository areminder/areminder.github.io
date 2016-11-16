<?php
// src/UsersBundle/Entity/User.php

namespace UsersBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Usuario")
 */
class Users extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="MainBundle\Entity\Tasks", mappedBy="user", cascade={"remove"})
     */
    protected $task;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->task = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Adiciona uma tarefa
     *
     * @param Tasks $task
     * @return Branch
     */
    public function addTask(Tasks $task)
    {
        $this->task[] = $task;

        return $this;
    }

    /**
     * Remove uma tarefa
     *
     * @param Tasks $task
     */
    public function removeTasks(Tasks $task)
    {
        $this->task->removeElement($task);
    }

    /**
     * Retorna uma tarefa
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->task;
    }
}