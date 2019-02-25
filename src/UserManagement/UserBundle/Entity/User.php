<?php

namespace UserManagement\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserManagement\UserBundle\Repository\UserRepository")
 */
class User
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
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     */
    private $lastName;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer")
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="project_name", type="string", length=255)
     */
    private $projectName;

    /**
     * @ORM\ManyToOne(targetEntity="UserManagement\UserBundle\Entity\RewardCategory")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rewardCategory;

    /**
     * @var int
     *
     * @ORM\Column(name="rewardCount", type="integer")
     */
    private $rewardCount;







    /**
    * ---------------------------------------------
    * ----------------METHODS----------------------
    * ---------------------------------------------
    */



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return User
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set projectName
     *
     * @param string $projectName
     *
     * @return User
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setRewardCount($newCount)
    {
        $this->rewardCount = $newCount;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getRewardCount()
    {
        return $this->rewardCount;
    }

    /**
     * Set RewardCateg
     *
     * @param \UserManagement\UserBundle\Entity\RewardCategory 
     * @return User
     */
    public function setRewardCateg(\UserManagement\UserBundle\Entity\RewardCategory $NewValue)
    {
        $this->rewardCategory = $NewValue;

        return $this;
    }

    /**
     * Get RewardCateg
     *
     * @return \UserManagement\UserBundle\Entity\RewardCategory 
     */
    public function getRewardCateg()
    {
        return $this->rewardCategory;
    }


}

