<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TurmaRepository")
 */
class Turma
{
    /**
     * @ORM\OneToMany(targetEntity="AvBase", mappedBy="idTurma", cascade={"persist","remove"})
     */
    private $avbase;

    public function __construct()
    {
        $this->avbase = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="TurmAluno", mappedBy="idTurma", cascade={"persist","remove"})
     */
    private $turmaluno;

    public function __constructA()
    {
        $this->turmaluno = new ArrayCollection();
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
     * @ORM\ManyToOne(targetEntity="Disciplina", cascade={"persist"}, inversedBy="turmas")
     * @ORM\JoinColumn(name="id_disc", referencedColumnName="id")
     */
    private $disciplina;

    /**
     * @ORM\ManyToOne(targetEntity="Professor", cascade={"persist"}, inversedBy="turmas")
     * @ORM\JoinColumn(name="id_prof", referencedColumnName="id")
     */
    private $professor;

    /**
     * @ORM\ManyToOne(targetEntity="Faculdade", cascade={"persist"}, inversedBy="turma")
     * @ORM\JoinColumn(name="id_facul", referencedColumnName="id")
     */
    private $faculdade;

    /**
     * @var string
     *
     * @ORM\Column(name="semestre_turma", type="string", length=255)
     */
    private $semestreTurma;


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
     * Set Disciplina
     *
     * @param integer $Disciplina
     *
     * @return Disciplina
     */
    public function setDisciplina($disciplina)
    {
        $this->disciplina = $disciplina;

        return $this;
    }

    /**
     * Get Disciplina
     *
     * @return Disciplina
     */
    public function getDisciplina()
    {
        return $this->disciplina;
    }

    /**
     * Set professor
     *
     * @param integer $professor
     *
     * @return Professor
     */
    public function setProfessor($professor)
    {
        $this->professor = $professor;

        return $this;
    }

    /**
     * Get professor
     *
     * @return Professor
     */
    public function getProfessor()
    {
        return $this->professor;
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
     * Set semestreTurma
     *
     * @param string $semestreTurma
     *
     * @return Turma
     */
    public function setSemestreTurma($semestreTurma)
    {
        $this->semestreTurma = $semestreTurma;

        return $this;
    }

    /**
     * Get semestreTurma
     *
     * @return string
     */
    public function getSemestreTurma()
    {
        return $this->semestreTurma;
    }

    /**
     * Set avbase
     *
     * @param integer $avbase
     *
     * @return AvBase
     */
    public function setAvBase($avbase)
    {
        $this->avbase = $avbase;

        return $this;
    }

    /**
     * Get avbase
     *
     * @return AvBase
     */
    public function getAvBase()
    {
        return $this->avbase;
    }
}