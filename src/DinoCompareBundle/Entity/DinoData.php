<?php

namespace DinoCompareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DinoData
 *
 * @ORM\Table(name="dino_data")
 * @ORM\Entity(repositoryClass="DinoCompareBundle\Repository\DinoDataRepository")
 */
class DinoData
{
    /**
     * @ORM\ManyToOne(targetEntity="FoodType", inversedBy="dinodata")
     */
    private $foodType;

    /**
     * @ORM\ManyToOne(targetEntity="Period", inversedBy="dinodata")
     */
    private $period;

    /**
     * @ORM\ManyToOne(targetEntity="DinoOrder", inversedBy="dinodata")
     */
    private $dinoOrder;

    /**
     * @ORM\ManyToOne(targetEntity="DinoSuborder", inversedBy="dinodata")
     */
    private $dinoSuborder;

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param mixed $period
     */
    public function setPeriod($period)
    {
        $this->period = $period;
    }

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
     * @ORM\Column(name="name", type="string", length=50, unique=true)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="weight", type="float")
     */
    private $weight;

    /**
     * @var float
     *
     * @ORM\Column(name="lenght", type="float")
     */
    private $lenght;

    /**
     * @var float
     *
     * @ORM\Column(name="height", type="float")
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="discoverYear", type="integer")
     */
    private $discoverYear;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=50)
     */
    private $path;


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
     * @return mixed
     */
    public function getFoodType()
    {
        return $this->foodType;
    }

    /**
     * @param mixed $foodType
     */
    public function setFoodType($foodType)
    {
        $this->foodType = $foodType;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return DinoData
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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

    /**
     * Set weight
     *
     * @param float $weight
     * @return DinoData
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Get weight
     *
     * @return float 
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set lenght
     *
     * @param float $lenght
     * @return DinoData
     */
    public function setLenght($lenght)
    {
        $this->lenght = $lenght;

        return $this;
    }

    /**
     * Get lenght
     *
     * @return float 
     */
    public function getLenght()
    {
        return $this->lenght;
    }

    /**
     * Set height
     *
     * @param float $height
     * @return DinoData
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return float 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set discoverYear
     *
     * @param integer $discoverYear
     * @return DinoData
     */
    public function setDiscoverYear($discoverYear)
    {
        $this->discoverYear = $discoverYear;

        return $this;
    }

    /**
     * Get discoverYear
     *
     * @return integer 
     */
    public function getDiscoverYear()
    {
        return $this->discoverYear;
    }

    /**
     * @return mixed
     */
    public function getDinoOrder()
    {
        return $this->dinoOrder;
    }

    /**
     * @param mixed $dinoOrder
     */
    public function setDinoOrder($dinoOrder)
    {
        $this->dinoOrder = $dinoOrder;
    }

    /**
     * @return mixed
     */
    public function getDinoSuborder()
    {
        return $this->dinoSuborder;
    }

    /**
     * @param mixed $dinoSuborder
     */
    public function setDinoSuborder($dinoSuborder)
    {
        $this->dinoSuborder = $dinoSuborder;
    }


}
