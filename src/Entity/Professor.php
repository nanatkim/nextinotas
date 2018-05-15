<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProfessorRepository")
 */
class Professor
{

    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="professor", cascade={"persist","remove"})
     */
    private $user;

    public function __constructUser()
    {
        $this->user = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Faculdade", cascade={"persist"}, inversedBy="professor")
     * @ORM\JoinColumn(name="id_facul", referencedColumnName="id")
     */
    private $faculdade;

    /**
     * @ORM\OneToMany(targetEntity="Turma", mappedBy="professor")
     */
    private $turmas;

    public function __constructTurma()
    {
        $this->turmas = new ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(name="email",type="string", length=255, unique=true)
     */
    protected $email;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get faculdade
     *
     * @return Faculdade
     */
    public function getFaculdade()
    {
        return $this->faculdade;
    }

    /**
     * Set faculdade
     *
     * @param integer $faculdade
     *
     * @return Faculdade
     */
    public function setFaculdade($faculdade)
    {
        $this->faculdade = $faculdade;

        return $this;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Professor
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }


    /**
     * Set turmas
     *
     * @param string $turmas
     *
     * @return Turma
     */
    public function setTurma($turmas)
    {
        $this->turmas = $turmas;

        return $this;
    }

    /**
     * Get turmas
     *
     * @return string
     */
    public function getTurmas()
    {
        return $this->turmas;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Email
     *
     * @return Professor
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }
}