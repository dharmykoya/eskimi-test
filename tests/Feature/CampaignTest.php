<?php

namespace Tests\Feature;

use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    /**
     * A basic feature test to check for validations.
     *
     * @return void
     */
    public function testCreateCampaignWithWrongData()
    {
        $response = $this->post('api/campaigns', [
            'name' => 'facebook campaign'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)->assertJson([
            'success' => false,
            'message' => 'The given data was invalid',
            'errors' => [
                "total_budget" =>  [
                    "The total budget field is required."
                ],
                "daily_budget" =>  [
                    "The daily budget field is required."
                ]
            ]
        ]);
    }

    /**
     * A basic feature test to test if campaigns can be created.
     *
     * @return void
     */
//    public function testCreateCampaign()
//    {
//        $response = $this->post('api/campaigns', Campaign::factory()->make()->toArray());
//        $response->assertStatus(Response::HTTP_CREATED)->assertJson([
//            'success' => true,
//            'message' => Lang::get('operation.store'),
//        ]);
//    }
}
