<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="This email address is already in use")
 */
class Usuario implements UserInterface
{
    /**
     * @ORM\Id;
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(name="name",type="string", length=40)
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Faculdade", cascade={"persist"}, inversedBy="user")
     * @ORM\JoinColumn(name="id_facul", referencedColumnName="id")
     */
    private $faculdade;

    /**
     * @ORM\ManyToOne(targetEntity="Professor", cascade={"persist"}, inversedBy="user")
     * @ORM\JoinColumn(name="id_professor", referencedColumnName="id")
     */
    private $professor;

    /**
     * @ORM\Column(name="role",type="string", length=50)
     */
    protected $role;

    /**
     * @Assert\Length(max=4096)
     */
    protected $plainPassword;

    /**
     * @ORM\Column(name="password", type="string", length=64)
     */
    protected $password;

    public function eraseCredentials()
    {
        return null;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role = null)
    {
        $this->role = $role;
    }

    public function getRoles()
    {
        return [$this->getRole()];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    public function getSalt()
    {
        return null;
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
     * Get professor
     *
     * @return Professor
     */
    public function getProfessor()
    {
        return $this->professor;
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
}