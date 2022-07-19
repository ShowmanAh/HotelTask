<?php

namespace Tests;
use Acme\Controllers\HotelController;
use Acme\View\ViewData;
use PHPUnit\Framework\TestCase;
use Acme\Adapter\MysqlAdapter;
use Acme\Models\Hotel;

require "../vendor/autoload.php";

class HotelsTest extends TestCase
{

    public function testValidConnectingParameters()
    {
        $mysqlAdapter = new MysqlAdapter(['localhost',
                'showman',
                'root',
                'task1'
               ]
        );
        $this->assertTrue(true);

    }

    public function testCanConnectOnce()
    {
        $mysqlAdapter = new MysqlAdapter(['localhost',
                'showman',
                'root',
                'task1']
        );
        $connection = $mysqlAdapter->connect();

        $this->assertIsObject($connection);

    }

    public function testCanDisConnectOnce()
    {
        $mysqlAdapter = new MysqlAdapter(['localhost',
                'showman',
                'root',
                'task1']
        );
        $mysqlAdapter->connect();
        $result = $mysqlAdapter->disconnect();
        $this->assertIsBool($result);

    }

    public function testCanGetHotels()
    {
        $mysqlAdapter = new MysqlAdapter(['localhost',
                'showman',
                'root',
                'task1']
        );

        $mysqlAdapter->connect();
        $view = new ViewData();
        $data = (new HotelController($view))->index();
        $this->assertIsArray($data);

    }
}