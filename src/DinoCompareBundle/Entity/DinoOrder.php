<?php

namespace DinoCompareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DinoOrder
 *
 * @ORM\Table(name="dino_order")
 * @ORM\Entity(repositoryClass="DinoCompareBundle\Repository\DinoOrderRepository")
 */
class DinoOrder
{
    /**
     * @ORM\OneToMany(targetEntity="DinoData", mappedBy="dinoOrder")
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
     * @return DinoOrder
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

}
