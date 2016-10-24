<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity
 * @Vich\Uploadable
 * @ORM\Table(name="carrusel")
 */
class Carrusel
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=5,
     *     max=255,
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $text;

  /**
   * NOTE: This is not a mapped field of entity metadata, just a simple property.
   *
   * @Vich\UploadableField(mapping="carrusel_images", fileNameProperty="imageName")
   *
   * @var File
   */
  private $imageFile;

  /**
   * @ORM\Column(type="string", length=255)
   *
   * @var string
   */
  private $imageName;


  public function setImageFile(File $image = null)
  {
    $this->imageFile = $image;

    // VERY IMPORTANT:
    // It is required that at least one field changes if you are using Doctrine,
    // otherwise the event listeners won't be called and the file is lost
    if ($image) {
      // if 'updatedAt' is not defined in your entity, use another property
      $this->updatedAt = new \DateTime('now');
    }
  }

  public function getImageFile()
  {
    return $this->imageFile;
  }





    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return Carrusel
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     * @return Carrusel
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string 
     */
    public function getImageName()
    {
        return $this->imageName;
    }
}
