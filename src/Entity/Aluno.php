<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlunoRepository")
 */
class Aluno
{
    /**
     * @ORM\OneToMany(targetEntity="TurmAluno", mappedBy="idAluno", cascade={"persist","remove"})
     */
    private $turmaluno;

    public function __constructTurmAluno()
    {
        $this->turmaluno = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Faculdade", cascade={"persist"}, inversedBy="aluno")
     * @ORM\JoinColumn(name="id_facul", referencedColumnName="id")
     */
    private $faculdade;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var int
     *
     * @ORM\Column(name="matricula", type="integer")
     */
    private $matricula;

    /**
     * @var string
     *
     * @ORM\Column(name="semestre", type="string", length=255)
     */
    private $semestre;

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
     * @return Aluno
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

    /**
     * Set matricula
     *
     * @param integer $matricula
     *
     * @return Aluno
     */
    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get matricula
     *
     * @return int
     */
    public function getMatricula()
    {
        return $this->matricula;
    }

    /**
     * Set semestre
     *
     * @param string $semestre
     *
     * @return Aluno
     */
    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;

        return $this;
    }

    /**
     * Get semestre
     *
     * @return string
     */
    public function getSemestre()
    {
        return $this->semestre;
    }
}