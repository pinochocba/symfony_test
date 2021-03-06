<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 */
class Company
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


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
     * @ORM\Column(type="string", length=100)
     */
    private $name;

     /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="GroupCompanys", inversedBy="companys")
     * @ORM\JoinColumn(name="gcompanys_id", referencedColumnName="id", nullable=false)
     */
    private $gcompanys;
    /**
     * Set name
     *
     * @param string $name
     * @return Company
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
     * Set description
     *
     * @param string $description
     * @return Company
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set gcompanys
     *
     * @param \AppBundle\Entity\GroupCompanys $gcompanys
     * @return Company
     */
    public function setGcompanys(\AppBundle\Entity\GroupCompanys $gcompanys)
    {
        $this->gcompanys = $gcompanys;

        return $this;
    }

    /**
     * Get gcompanys
     *
     * @return \AppBundle\Entity\GroupCompanys 
     */
    public function getGcompanys()
    {
        return $this->gcompanys;
    }
}
