<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvAlunoRepository")
 */
class AvAluno
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="nota", type="float")
     */
    private $nota;

    /**
     * @ORM\ManyToOne(targetEntity="AvBase", cascade={"persist"}, inversedBy="avaluno")
     * @ORM\JoinColumn(name="id_avbase", referencedColumnName="id")
     */
    private $idAvbase;

    /**
     * @ORM\ManyToOne(targetEntity="TurmAluno", cascade={"persist"}, inversedBy="avaluno")
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
     * Set nota
     *
     * @param float $nota
     *
     * @return AvAluno
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return float
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set idAvbase
     *
     * @param integer $idAvbase
     *
     * @return AvAluno
     */
    public function setIdAvbase($idAvbase)
    {
        $this->idAvbase = $idAvbase;

        return $this;
    }

    /**
     * Get idAvbase
     *
     * @return int
     */
    public function getIdAvbase()
    {
        return $this->idAvbase;
    }

    /**
     * Set idAluno
     *
     * @param integer $idAluno
     *
     * @return AvAluno
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