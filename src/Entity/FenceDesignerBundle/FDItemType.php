<?php
namespace App\Entity\FenceDesignerBundle;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"item_list"}}
 * )
 * @ORM\Entity
 */
class FDItemType
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"item_list", "object_list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Groups({"item_list", "object_list"})
     */
    public $name;

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
}