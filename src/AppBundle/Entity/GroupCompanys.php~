<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * GroupCompanys
 *
 * @ORM\Table(name="group_companys")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupCompanysRepository")
 */
class GroupCompanys
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
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Company", mappedBy="gcompanys")
     */
    private $companys;

    public function __construct()
    {
        $this->companys = new ArrayCollection();
    }

    /**
     * Add companys
     *
     * @param \AppBundle\Entity\Company $companys
     * @return GroupCompanys
     */
    public function addCompany(\AppBundle\Entity\Company $companys)
    {
        $this->companys[] = $companys;

        return $this;
    }

    /**
     * Remove companys
     *
     * @param \AppBundle\Entity\Company $companys
     */
    public function removeCompany(\AppBundle\Entity\Company $companys)
    {
        $this->companys->removeElement($companys);
    }

    /**
     * Get companys
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCompanys()
    {
        return $this->companys;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return GroupCompanys
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
     * @return GroupCompanys
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
}
