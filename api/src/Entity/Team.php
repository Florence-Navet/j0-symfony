<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/** Une équipe (« roster ») de la ligue. */
#[ORM\Entity(repositoryClass: TeamRepository::class)]
#[UniqueEntity('name', message: 'Ce nom d\'équipe est déjà pris.')]
#[UniqueEntity('tag', message: 'Ce tag est déjà utilisé.')]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['team:read'])]
    private ?int $id = null;

    /** Nom complet de l'équipe (unique). */
    #[ORM\Column(length: 50, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 50)]
    #[Groups(['team:read', 'team:write'])]
    private ?string $name = null;

    /** Abréviation affichée sur les scoreboards : 2 à 5 majuscules ou chiffres (ex. « NUL »). */
    #[ORM\Column(length: 5, unique: true)]
    #[Assert\NotBlank]
    #[Assert\Regex('/^[A-Z0-9]{2,5}$/', message: 'Le tag doit faire 2 à 5 caractères en majuscules ou chiffres.')]
    #[Groups(['team:read', 'team:write'])]
    private ?string $tag = null;

    /** Pays de l'équipe, code ISO 3166-1 alpha-2 (ex. « FR »). */
    #[ORM\Column(length: 2)]
    #[Assert\NotBlank]
    #[Assert\Country]
    #[Groups(['team:read', 'team:write'])]
    private ?string $country = null;

    // … getters et setters générés par le maker
}
