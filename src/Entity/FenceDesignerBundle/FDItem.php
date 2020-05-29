<?php
// api/src/Entity/FDItem.php

namespace App\Entity\FenceDesignerBundle;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *     attributes={"filters"={"configuration"}},
 *     normalizationContext={"groups"={"item_list"}}
 * )
 * @ApiFilter(
 *     SearchFilter::class, properties={"configuration": "exact"}
 * )
 * @ORM\Entity
 */
class FDItem // The class name will be used to name exposed resources
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"item_list", "object_list"})
     */
    public $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"item_list", "object_list"})
     */
    public $width;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"item_list", "object_list"})
     */
    public $depth;

    /**
     * @ORM\Column(type="float")
     * @Groups({"item_list", "object_list"})
     */
    public $height;

    /**
     * @ORM\Column(type="float")
     * @Groups({"item_list", "object_list"})
     */
    public $weight;

    /**
     * @ORM\ManyToOne(targetEntity=FDItemType::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"item_list", "object_list"})
     */
    public $itemType;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"item_list", "object_list"})
     */
    public $widthLeft;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups({"item_list", "object_list"})
     */
    public $widthRight;

    /**
     * @ORM\ManyToOne(targetEntity=FDConfiguration::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"item_list", "object_list"})
     */
    private $configuration;

    /**
     * @ORM\OneToMany(targetEntity=FDItemColor::class, mappedBy="item")
     * @Groups({"item_list", "object_list"})
     */
    private $itemColors;

    public function __construct()
    {
        $this->itemColors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param mixed $width
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @return mixed
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param mixed $depth
     */
    public function setDepth($depth): void
    {
        $this->depth = $depth;
    }

    /**
     * @return mixed
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param mixed $height
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * @param mixed $itemType
     */
    public function setItemType($itemType): void
    {
        $this->itemType = $itemType;
    }

    /**
     * @return mixed
     */
    public function getWidthLeft()
    {
        return $this->widthLeft;
    }

    /**
     * @param mixed $widthLeft
     */
    public function setWidthLeft($widthLeft): void
    {
        $this->widthLeft = $widthLeft;
    }

    /**
     * @return mixed
     */
    public function getWidthRight()
    {
        return $this->widthRight;
    }

    /**
     * @param mixed $widthRight
     */
    public function setWidthRight($widthRight): void
    {
        $this->widthRight = $widthRight;
    }

    public function getConfiguration(): ?FDConfiguration
    {
        return $this->configuration;
    }

    public function setConfiguration(?FDConfiguration $configuration): self
    {
        $this->configuration = $configuration;

        return $this;
    }

    /**
     * @return Collection|FDItemColor[]
     */
    public function getItemColors(): Collection
    {
        return $this->itemColors;
    }

    public function addItemColor(FDItemColor $itemColor): self
    {
        if (!$this->itemColors->contains($itemColor)) {
            $this->itemColors[] = $itemColor;
            $itemColor->setItem($this);
        }

        return $this;
    }

    public function removeItemColor(FDItemColor $itemColor): self
    {
        if ($this->itemColors->contains($itemColor)) {
            $this->itemColors->removeElement($itemColor);
            // set the owning side to null (unless already changed)
            if ($itemColor->getItem() === $this) {
                $itemColor->setItem(null);
            }
        }

        return $this;
    }
}