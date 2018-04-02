<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DisciplinaRepository")
 */
class Disciplina
{
    /**
     * @ORM\ManyToOne(targetEntity="Faculdade", cascade={"persist"}, inversedBy="disciplina")
     * @ORM\JoinColumn(name="id_facul", referencedColumnName="id")
     */
    private $faculdade;

    /**
     * @ORM\OneToMany(targetEntity="Turma", mappedBy="disciplina", cascade={"persist","remove"})
     */
    private $turmas;

    public function __constructTurma()
    {
        $this->turmas = new ArrayCollection();
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
     * @return Disciplina
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
     * Get faculdade
     *
     * @return Faculdade
     */
    public function getFaculdade()
    {
        return $this->faculdade;
    }
}