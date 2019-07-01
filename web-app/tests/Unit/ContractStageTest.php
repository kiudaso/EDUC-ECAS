<?php

namespace Tests\Feature;

use App\Dynamics\ContractStage;

use App\Dynamics\Decorators\CacheDecorator;
use Tests\TestCase;

class ContractStageTest extends TestCase
{

    public $api;
    public $fake;

    public function setUp(): void
    {
        parent::setUp();
        $this->api = new ContractStage();
        $this->fake = new \App\MockEntities\Repository\ContractStage(new \App\MockEntities\ContractStage());
    }


    /** @test */
    public function get_all_contracts_from_api()
    {
        $results = $this->api->all();
        $this->assertInstanceOf('Illuminate\Support\Collection', $results);
        $this->verifySingle($results->first());

    }


    /** @test */
    public function get_all_contracts_from_api_via_the_cache()
    {
        $results = (new CacheDecorator($this->api))->all();
        $this->assertInstanceOf('Illuminate\Support\Collection', $results);
        $this->verifySingle($results->first());

    }

    /** @test */
    public function get_all_fake_records()
    {
        // TODO - remove toArray() below - collection
        $results = $this->fake->all();
        $this->assertInstanceOf('Illuminate\Support\Collection', $results);
        $this->verifySingle($results->first());

    }


    /** @test */
    public function get_all_fake_records_via_the_cache()
    {
        // TODO - remove toArray() below - collection
        $results = (new CacheDecorator($this->fake))->all();
        $this->assertInstanceOf('Illuminate\Support\Collection', $results);
        $this->verifySingle($results->first());

    }



    private function verifySingle($result)
    {
        $this->assertIsArray($result);
        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('name', $result);

    }


}
