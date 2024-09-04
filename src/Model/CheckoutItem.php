<?php

namespace LatestArifSdk\Php\Models;

class CheckoutItem
{
    public $name;
    public $quantity;
    public $price;
    public $image;
    public $description;

    public function __construct($name, $quantity, $price, $image, $description )
    {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->image = $image;
        $this->description = $description;
    }
}