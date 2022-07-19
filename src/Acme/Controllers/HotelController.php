<?php
namespace Acme\Controllers;
use Acme\Models\Hotel;
use Acme\View\ViewData;
class HotelController
{
    public function __construct(private ViewData $viewData)
    {

    }
    public function index()
    {
        $hotel = new Hotel();
        $hotels = $hotel->getHotels();

        if (isset($_GET['search'])){
            $hotels = $hotel->searchHotels($_GET['search']);
        }
        $this->viewData->printData($hotels);
    }
}