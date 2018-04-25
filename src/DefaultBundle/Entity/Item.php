<?php

namespace DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table(name="item")
 * @ORM\Entity(repositoryClass="DefaultBundle\Repository\ItemRepository")
 */
class Item
{
    /**
     * @var int
     *
     * @ORM\Column(name="index", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $index;

    /**
     * @var int
     *
     * @ORM\Column(name="index_start_at", type="integer", unique=true)
     */
    private $index_start_at;

    /**
     * @var int
     *
     * @ORM\Column(name="integer", type="integer")
     */
    private $integer;

    /**
     * @var float
     *
     * @ORM\Column(name="float", type="float")
     */
    private $float;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="fullname", type="string", length=255)
     */
    private $fullname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="bool", type="boolean")
     */
    private $bool;


    /**
     * Get index
     *
     * @return int
     */
    public function getIndex()
    {
        return $this->index;
    }

    /**
     * Set indexas
     *
     * @param integer $indexas
     *
     * @return Item
     */
    public function setIndex($index)
    {
        $this->index = $index;

        return $this;
    }

    /**
     * Set index_start_at
     *
     * @param integer $index_start_at
     *
     * @return Item
     */
    public function setIndexStartAt($index_start_at)
    {
        $this->index_start_at = $index_start_at;

        return $this;
    }

    /**
     * Get index_start_at
     *
     * @return int
     */
    public function getIndexStartAt()
    {
        return $this->index_start_at;
    }

    /**
     * Set integer
     *
     * @param integer $integer
     *
     * @return Item
     */
    public function setInteger($integer)
    {
        $this->integer = $integer;

        return $this;
    }

    /**
     * Get integer
     *
     * @return int
     */
    public function getInteger()
    {
        return $this->integer;
    }

    /**
     * Set float
     *
     * @param float $float
     *
     * @return float
     */
    public function setFloat($float)
    {
        $this->float = $float;

        return $this;
    }

    /**
     * Get float
     *
     * @return float
     */
    public function getFloat()
    {
        return $this->float;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Item
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
     * Set surname
     *
     * @param string
     *
     * @return string
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set fullname
     *
     * @param string $fullname
     *
     * @return string
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $this;
    }

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return string
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set bool
     *
     * @param boolean $bool
     *
     * @return boolean
     */
    public function setBool($bool)
    {
        $this->bool = $bool;

        return $this;
    }

    /**
     * Get bool
     *
     * @return bool
     */
    public function getBool()
    {
        return $this->bool;
    }
}

