<?php

use Illuminate\Support\Facades\Artisan;

abstract class ApiTester extends Illuminate\Foundation\Testing\TestCase
{

    public function setUp()
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
        $_POST = array();
    }

    /**
     * Gets JSON output from API
     * @param $uri
     * @param string $method
     * @param array $parameters
     * @return mixed
     */

    protected function getJson($uri, $method = 'GET', $parameters = [])
    {
        return json_decode($this->call($method, $uri, $parameters)->getContent());
    }


    protected function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach ($args as $attribute) {
            $this->assertObjectHasAttribute($attribute, $object);
        }
    }

    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

        return $app;
    }

} 