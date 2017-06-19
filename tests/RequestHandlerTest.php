<?php
use \Dialect\Unifaun\RequestHandler;

use Tests\TestCase;
class RequestHandlerTest extends TestCase
{

    /** @test */
    public function request_handler_returns_json(){
        //TODO: CHANGE THIS TO URL FROM APP
        config(['unifaun.url' => "http://api.dryg.net/dagar/v2.1/2015/01/06"]);
        $this->assertJson(json_encode(RequestHandler::Request('/', 'GET')));
    }

    //TODO: ADD POST AND GET TESTERS



}