<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\Post;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
#[ApiResource(normalizationContext:['groups' => ['read']],
    operations:[
        new Get(uriTemplate:'/roles/{id}'),
        new GetCollection(uriTemplate: '/roles'),
        new Post(uriTemplate:'/roles'),
        new Put(uriTemplate: '/roles/{id}'),
        new Delete(uriTemplate:'/roles/{id}'),
    ]
)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("read")]
    private ?string $roleName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoleName(): ?string
    {
        return $this->roleName;
    }

    public function setRoleName(string $roleName): static
    {
        $this->roleName = $roleName;

        return $this;
    }
}
