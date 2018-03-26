<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvBaseRepository")
 */
class AvBase
{
    /**
     * @ORM\OneToMany(targetEntity="AvAluno", mappedBy="idAvbase", cascade={"persist","remove"})
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
     * @var float
     *
     * @ORM\Column(name="nota_max", type="float")
     */
    private $notaMax;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255)
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="AvTipo", cascade={"persist"}, inversedBy="avbase")
     * @ORM\JoinColumn(name="id_tipo", referencedColumnName="id")
     */
    private $idTipo;

    /**
     * @ORM\ManyToOne(targetEntity="Turma", cascade={"persist"}, inversedBy="avbase")
     * @ORM\JoinColumn(name="id_turma", referencedColumnName="id")
     */
    private $idTurma;


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
     * Set notaMax
     *
     * @param float $notaMax
     *
     * @return AvBase
     */
    public function setNotaMax($notaMax)
    {
        $this->notaMax = $notaMax;

        return $this;
    }

    /**
     * Get notaMax
     *
     * @return float
     */
    public function getNotaMax()
    {
        return $this->notaMax;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return string
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
     * Set idTipo
     *
     * @param integer $idTipo
     *
     * @return AvTipo
     */
    public function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;

        return $this;
    }

    /**
     * Get idTipo
     *
     * @return AvTipo
     */
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    /**
     * Set idTurma
     *
     * @param integer $idTurma
     *
     * @return Turma
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
}