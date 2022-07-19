<?php
namespace Acme\View;
class ViewData
{

    public function printData($hotels = []): void
    {
        if (count($hotels) > 0){
            foreach ($hotels as $hotel)
            {
                echo $hotel['id'] . '<br>';
                echo $hotel['name'] . '<br>';
                echo $hotel['room'] . '<br>';
                echo $hotel['location'] . '<br>';
                echo $hotel['flat_no'] . '<br>';
                echo $hotel['adults_no'] . '<br>';
            }
        }

    }

}