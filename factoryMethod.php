<?php
require "vendor/autoload.php";
use Acme\Creational\FactoryMethod\ToyotaBrandFactory;
use Acme\Creational\FactoryMethod\BrandFactory;
use Acme\Creational\FactoryMethod\BmwBrandFactory;
error_reporting(E_ALL);
ini_set('display_errors', '1');
function testFactory(BrandFactory $factoryBrand)
{
   return $factoryBrand->generateCar();
}
echo "testing Bmw Concrete : \n";
echo testFactory(new BmwBrandFactory());
echo "\n";
echo "testing Toyota Concrete: \n";
echo testFactory(new ToyotaBrandFactory());
