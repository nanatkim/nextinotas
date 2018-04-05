<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FaculdadeRepository")
 */
class Faculdade
{
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="faculdade", cascade={"persist","remove"})
     */
    private $user;

    public function __constructUser()
    {
        $this->user = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Disciplina", mappedBy="faculdade", cascade={"persist","remove"})
     */
    private $disciplina;

    public function __constructDisciplina()
    {
        $this->disciplina = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="AvTipo", mappedBy="faculdade", cascade={"persist","remove"})
     */
    private $avtipo;

    public function __constructAvTipo()
    {
        $this->avtipo = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Professor", mappedBy="faculdade", cascade={"persist","remove"})
     */
    private $professor;

    public function __constructProf()
    {
        $this->professor = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Aluno", mappedBy="faculdade", cascade={"persist","remove"})
     */
    private $aluno;

    public function __constructAluno()
    {
        $this->aluno = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="Turma", mappedBy="faculdade", cascade={"persist","remove"})
     */

    private $turma;

    public function __constructTurma()
    {
        $this->turma = new ArrayCollection();
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
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;


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
     * Set nome
     *
     * @param string $nome
     *
     * @return Faculdade
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
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
}