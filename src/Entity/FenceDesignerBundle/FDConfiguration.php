<?php
namespace App\Entity\FenceDesignerBundle;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(normalizationContext={"groups"={"configuration_list"}})
 * @ORM\Entity
 */
class FDConfiguration
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"configuration_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Groups({"configuration_list"})
     */
    public $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"configuration_list"})
     */
    public $description;

    /**
     * @ORM\ManyToOne(targetEntity=FDType::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"configuration_list"})
     */
    public $type;

    /**
     * @ORM\OneToMany(targetEntity=FDItem::class, mappedBy="configuration")
     */
    private $items;

    /**
     * @ORM\Column(type="bigint")
     * @Groups({"configuration_list"})
     */
    private $defaultSectionWidth;

    public function __construct()
    {
        // ..

        $this->items = new ArrayCollection();    }

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return Collection|FDItem[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(FDItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setConfiguration($this);
        }

        return $this;
    }

    public function removeItem(FDItem $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getConfiguration() === $this) {
                $item->setConfiguration(null);
            }
        }

        return $this;
    }

    public function getItemsDataAsArray(): array
    {
        if ($this->items instanceof Collection) {
            return $this->items->getValues();
        }

        return (array) $this->item;
    }

    public function getDefaultSectionWidth(): ?string
    {
        return $this->defaultSectionWidth;
    }

    public function setDefaultSectionWidth(string $defaultSectionWidth): self
    {
        $this->defaultSectionWidth = $defaultSectionWidth;

        return $this;
    }
}