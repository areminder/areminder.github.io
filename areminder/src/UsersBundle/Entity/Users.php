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
    protected $tasks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Adiciona uma tarefa
     *
     * @param Tasks $task
     * @return Branch
     */
    public function addTask(Tasks $task)
    {
        $this->tasks[] = $tasks;

        return $this;
    }

    /**
     * Remove uma tarefa
     *
     * @param Tasks $tasks
     */
    public function removeTasks(Tasks $tasks)
    {
        $this->tasks->removeElement($tasks);
    }

    /**
     * Retorna uma tarefa
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}