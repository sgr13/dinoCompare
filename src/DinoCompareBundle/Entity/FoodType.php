<?php

namespace DinoCompareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FoodType
 *
 * @ORM\Table(name="food_type")
 * @ORM\Entity(repositoryClass="DinoCompareBundle\Repository\FoodTypeRepository")
 */
class FoodType
{
    /**
     * @ORM\OneToMany(targetEntity="DinoData", mappedBy="foodType")
     */
    private $dinoData;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;


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
     * Set name
     *
     * @param string $name
     * @return FoodType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDinoData()
    {
        return $this->dinoData;
    }

    /**
     * @param mixed $dinoData
     */
    public function setDinoData($dinoData)
    {
        $this->dinoData = $dinoData;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
}
