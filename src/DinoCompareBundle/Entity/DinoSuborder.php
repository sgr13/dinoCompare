<?php

namespace DinoCompareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DinoSuborder
 *
 * @ORM\Table(name="dino_suborder")
 * @ORM\Entity(repositoryClass="DinoCompareBundle\Repository\DinoSuborderRepository")
 */
class DinoSuborder
{
    /**
     * @ORM\OneToMany(targetEntity="DinoData", mappedBy="dinoSuborder")
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
     * @var string
     *
     * @ORM\Column(name="suborderPath", type="string", length=250)
     */
    private $suborderPath;


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
     * @return DinoSuborder
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

    /**
     * @return string
     */
    public function getSuborderPath()
    {
        return $this->suborderPath;
    }

    /**
     * @param string $suborderPath
     */
    public function setSuborderPath($suborderPath)
    {
        $this->suborderPath = $suborderPath;
    }

    public function getWebPath()
    {
        return 'photo/'.$this->suborderPath;
    }

}
