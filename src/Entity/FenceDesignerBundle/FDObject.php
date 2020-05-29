<?php
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
 *     normalizationContext={"groups"={"object_list"}}
 * )
 * @ApiFilter(
 *     SearchFilter::class, properties={"configuration": "exact"}
 * )
 * @ORM\Entity
 */
class FDObject
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"object_list"})
     */
    public $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Groups({"object_list"})
     */
    public $name;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Groups({"object_list"})
     */
    public $defaultWidth;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Groups({"object_list"})
     */
    public $defaultHeight;

    /**
     * @ORM\ManyToOne(targetEntity=FDConfiguration::class, inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"object_list"})
     */
    private $configuration;

    /**
     * @ORM\ManyToOne(targetEntity=FDObjectType::class)
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"object_list"})
     */
    public $objectType;

//    /**
//     * @ORM\OneToMany(targetEntity=FDItem::class, mappedBy="object")
//     */
//    private $items;

    /**
     * @ORM\ManyToOne(targetEntity=FDItem::class)
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"object_list"})
     */
    public $brick;

    /**
     * @ORM\ManyToOne(targetEntity=FDItem::class)
     * @ORM\JoinColumn(nullable=true)
     * @Groups({"object_list"})
     */
    public $roof;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
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
    public function getDefaultWidth()
    {
        return $this->defaultWidth;
    }

    /**
     * @param mixed $defaultWidth
     */
    public function setDefaultWidth($defaultWidth): void
    {
        $this->defaultWidth = $defaultWidth;
    }

    /**
     * @return mixed
     */
    public function getDefaultHeight()
    {
        return $this->defaultHeight;
    }

    /**
     * @param mixed $defaultHeight
     */
    public function setDefaultHeight($defaultHeight): void
    {
        $this->defaultHeight = $defaultHeight;
    }

    /**
     * @return mixed
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param mixed $configuration
     */
    public function setConfiguration($configuration): void
    {
        $this->configuration = $configuration;
    }

    public function getObjectType(): ?FDObjectType
    {
        return $this->objectType;
    }

    public function setObjectType(?FDObjectType $objectType): self
    {
        $this->objectType = $objectType;

        return $this;
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
            $item->setObject($this);
        }

        return $this;
    }

    public function removeItem(FDItem $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getObject() === $this) {
                $item->setObject(null);
            }
        }

        return $this;
    }

    public function getBrick(): ?FDItem
    {
        return $this->brick;
    }

    public function setBrick(?FDItem $brick): self
    {
        $this->brick = $brick;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRoof()
    {
        return $this->roof;
    }

    /**
     * @param mixed $roof
     */
    public function setRoof($roof): void
    {
        $this->roof = $roof;
    }
}