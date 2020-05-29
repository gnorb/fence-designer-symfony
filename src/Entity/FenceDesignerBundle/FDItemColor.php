<?php

namespace App\Entity\FenceDesignerBundle;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity
 */
class FDItemColor
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=30)
     */
    public $color;

    /**
     * @ORM\Column(type="string", length=30)
     */
    public $texture;

    /**
     * @ORM\ManyToOne(targetEntity=FDItem::class, inversedBy="itemColors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $item;

    public function __construct()
    {
        // ..
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color): void
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getTexture()
    {
        return $this->texture;
    }

    /**
     * @param mixed $texture
     */
    public function setTexture($texture): void
    {
        $this->texture = $texture;
    }

    public function getItem(): ?FDItem
    {
        return $this->item;
    }

    public function setItem(?FDItem $item): self
    {
        $this->item = $item;

        return $this;
    }
}