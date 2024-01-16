<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

// En implementant l'interface, j'indique que la classe User peut etre utilisé avec le hachage de mot de passe  de symfony
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Role $role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): static
    {
        $this->role = $role;

        return $this;
    }
    // methode abstraite de UserInterface
    /**
     * retourne les roles utilisateurs
     */
    public function getRoles():array{
        return ['ROLE_USER'];
    }
    public function getSalt(){
        return null;
    }
    /**
     * permet d'effacer les données sensibles de l'utilisateur en l'occurence password
     *  */ 
    public function eraseCredentials():void{
        $this->password=null;
    }
    /**
     * Retourne un identifiant pour l'utilisateur
     */
    public function getUserIdentifier():string{
        return $this->username;
    }
}
