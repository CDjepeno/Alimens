<?php

namespace App\Entity;

use App\Repository\AlimentRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=AlimentRepository::class)
 * @UniqueEntity(fields={"name"}, message="Un aliment as déja ce nom")
 * @Vich\Uploadable
 */
class Aliment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=15, minMessage="Le nom doit être supérieur a 3 caractères", maxMessage="Le nom doit être inférieur à 15 caractères")
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(min=0.1, max=100, minMessage="Le prix doit être supérieur a 0.1", maxMessage="Le prix doit être inférieur à 100")
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="aliment_image", fileNameProperty="image")
     * @var File|null
     */
    private $imageFile;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="vous devez renseigner les calories")
     * @Assert\Positive(message="le chiffre doit être positif")
     */
    private $calory;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="vous devez renseigner les proteines")
     * @Assert\Positive(message="le chiffre doit être positif")
     */
    private $proteine;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="vous devez renseigner les glucides")
     * @Assert\Positive(message="le chiffre doit être positif")
     */
    private $glucide;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="vous devez renseigner les lipides")
     * @Assert\Positive(message="le chiffre doit être positif")
     */
    private $lipide;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="aliments")
     */
    private $type;

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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCalory(): ?int
    {
        return $this->calory;
    }

    public function setCalory(int $calory): self
    {
        $this->calory = $calory;

        return $this;
    }

    public function getProteine(): ?float
    {
        return $this->proteine;
    }

    public function setProteine(float $proteine): self
    {
        $this->proteine = $proteine;

        return $this;
    }

    public function getGlucide(): ?float
    {
        return $this->glucide;
    }

    public function setGlucide(float $glucide): self
    {
        $this->glucide = $glucide;

        return $this;
    }

    public function getLipide(): ?float
    {
        return $this->lipide;
    }

    public function setLipide(float $lipide): self
    {
        $this->lipide = $lipide;

        return $this;
    }

    /**
     * Get the value of imageFile
     */ 
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @return  self
     */ 
    public function setImageFile(?File $imageFile = null): self
    {
        $this->imageFile = $imageFile;

        if($this->imageFile instanceof UploadedFile) {
            $this->updated_at = new \DateTime('now');
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
