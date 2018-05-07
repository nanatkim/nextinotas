<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TurmAlunoRepository")
 */
class TurmAluno
{
    /**
     * @ORM\OneToMany(targetEntity="AvAluno", mappedBy="idAluno", cascade={"persist","remove"})
     */
    private $avaluno;

    public function __constructAvAluno()
    {
        $this->avaluno = new ArrayCollection();
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
     * @ORM\ManyToOne(targetEntity="Turma", cascade={"persist"}, inversedBy="turmaluno")
     * @ORM\JoinColumn(name="id_turma", referencedColumnName="id")
     */
    private $idTurma;

    /**
     * @ORM\ManyToOne(targetEntity="Aluno", cascade={"persist"}, inversedBy="turmaluno")
     * @ORM\JoinColumn(name="id_aluno", referencedColumnName="id")
     */
    private $idAluno;


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
     * Set idTurma
     *
     * @param integer $idTurma
     *
     * @return TurmAluno
     */
    public function setIdTurma($idTurma)
    {
        $this->idTurma = $idTurma;

        return $this;
    }

    /**
     * Get idTurma
     *
     * @return Turma
     */
    public function getIdTurma()
    {
        return $this->idTurma;
    }

    /**
     * Set idAluno
     *
     * @param integer $idAluno
     *
     * @return TurmAluno
     */
    public function setIdAluno($idAluno)
    {
        $this->idAluno = $idAluno;

        return $this;
    }

    /**
     * Get idAluno
     *
     * @return Aluno
     */
    public function getIdAluno()
    {
        return $this->idAluno;
    }
}