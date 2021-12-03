<?php

class B
{
    private $nombre;
    public function __get($property)
    {
        return $this->$property;
    }

    public function __set($property, $value)
    {
        $this->$property = $value;
    }

}

class C extends B
{
    private $var1;
    private $var2;

}

$obj = new B();
echo $obj->antonio = "antonio";