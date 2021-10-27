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
    use RefreshDatabase;

    public $campaignA;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed --class=CampaignSeeder');
        $this->campaignA = Campaign::create(Campaign::factory()->make()->toArray());
    }
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
    public function testCreateCampaign()
    {
        $response = $this->post('api/campaigns', Campaign::factory()->make()->toArray());
        $response->assertStatus(Response::HTTP_CREATED)->assertJson([
            'success' => true,
            'message' => Lang::get('operation.store'),
        ]);
    }


    /**
     * A basic feature test to test if campaigns can be updated.
     *
     * @return void
     */
    public function testUpdateCampaign()
    {
        $response = $this->put("api/campaigns/{$this->campaignA->id}", [
            'name' => 'damilola insta',
            'total_budget' => 800000,
            'daily_budget' => 900
        ]);
        $response->assertStatus(Response::HTTP_OK)->assertJson([
            'success' => true,
            'message' => Lang::get('operation.update'),
        ]);
    }
}
