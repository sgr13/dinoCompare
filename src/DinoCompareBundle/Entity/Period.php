<?php

namespace DinoCompareBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Period
 *
 * @ORM\Table(name="period")
 * @ORM\Entity(repositoryClass="DinoCompareBundle\Repository\PeriodRepository")
 */
class Period
{
    /**
     * @ORM\OneToMany(targetEntity="DinoData", mappedBy="period")
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
     * @ORM\Column(name="name", type="string", length=255)
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
     * @return Period
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
