<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity("name", message="Ce nom est déja utiliser")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=10, minMessage="Votre nom doit comporter au moins 5 caractères", maxMessage="Votre nom doit doit comporter au maximum 10 caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5,max=10, minMessage="Le mot de passe doit comporter au moins 5 caractères", maxMessage="Le mot de passe doit doit comporter au maximum 10 caractères")
     */
    private $password;

    /** 
     * 
     * @Assert\EqualTo(propertyPath="password", message="Le mot de passe ne correspond pas")
     */
    private $checkPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of checkPassword
     */ 
    public function getCheckPassword()
    {
        return $this->checkPassword;
    }

    /**
     * Set the value of checkPassword
     *
     * @return  self
     */ 
    public function setCheckPassword($checkPassword)
    {
        $this->checkPassword = $checkPassword;

        return $this;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getSalt(){
        // ..
    }

    public function getUsername() {
        return $this->name;
    }

    public function eraseCredentials(){
        // ..
    }

    public function getRole(): ?string
    {
        return [$this->role];
    }

    public function setRole(?string $role): self
    {
        if ($role === null) {
            $this->role = "ROLE_USER";
        } else {
            $this->role = $role;
        }

        return $this;
    }


}
