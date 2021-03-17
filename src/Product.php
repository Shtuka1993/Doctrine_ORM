<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity 
 * @ORM\Table(name="products")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /** 
     * @ORM\Column(type="string") 
     */
    protected $name;

    /**
     * 
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     */
    public function setName(string $name) {
        $this->name = $name;
    }

    /**
     * 
     */
    public function getName():string {
        return $this->name;
    }
}