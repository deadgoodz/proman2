<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductTypeFields
 *
 * @ORM\Table(name="product_type_fields")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProductTypeFieldsRepository")
 */
class ProductTypeFields
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
     * @var int
     *
     * @ORM\Column(name="product_type_id", type="integer")
     */
    private $productTypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


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
     * Set productTypeId
     *
     * @param integer $productTypeId
     *
     * @return ProductTypeFields
     */
    public function setProductTypeId($productTypeId)
    {
        $this->productTypeId = $productTypeId;

        return $this;
    }

    /**
     * Get productTypeId
     *
     * @return int
     */
    public function getProductTypeId()
    {
        return $this->productTypeId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ProductTypeFields
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
}

