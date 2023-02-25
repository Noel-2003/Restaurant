<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FoodRepository::class)
 */
class Food
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\ManyToMany(targetEntity=Chef::class, inversedBy="food")
     */
    private $ChefID;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Category;

    /**
     * @ORM\Column(type="integer")
     */
    private $UnitPrice;

    public function __construct()
    {
        $this->ChefID = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection<int, Chef>
     */
    public function getChefID(): Collection
    {
        return $this->ChefID;
    }

    public function addChefID(Chef $chefID): self
    {
        if (!$this->ChefID->contains($chefID)) {
            $this->ChefID[] = $chefID;
        }

        return $this;
    }

    public function removeChefID(Chef $chefID): self
    {
        $this->ChefID->removeElement($chefID);

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->Category;
    }

    public function setCategory(string $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getUnitPrice(): ?int
    {
        return $this->UnitPrice;
    }

    public function setUnitPrice(int $UnitPrice): self
    {
        $this->UnitPrice = $UnitPrice;

        return $this;
    }
}