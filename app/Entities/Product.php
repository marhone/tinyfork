<?php
/**
 * Product Entity
 * User: marhone
 * Date: 2019/1/11
 * Time: 11:24
 */

namespace App\Entities;


class Product
{
    protected $id;

    protected $name;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}