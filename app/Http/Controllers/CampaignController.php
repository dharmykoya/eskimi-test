<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use App\Services\CampaignService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use App\Models\Image;

class CampaignController extends Controller
{
    protected $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    /**
     * Display a listing of the resource.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $campaigns = $this->campaignService->getAllCampaigns();
        return $this->success(CampaignResource::collection($campaigns), Lang::get('operation.all'));
    }


    /**
     * Display the specified resource.
     *
     * @param Campaign $campaign
     * @return JsonResponse
     */
    public function show(Campaign $campaign): JsonResponse
    {
        return $this->success(new CampaignResource($campaign), Lang::get('operation.get'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCampaignRequest $request
     * @return JsonResponse
     */
    public function store(CreateCampaignRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $campaign = $this->campaignService->createCampaign($request->validated());

            DB::commit();
            return $this->success(
                new CampaignResource($campaign),
                Lang::get('operation.store'),
                Response::HTTP_CREATED
            );
        } catch (Exception $e) {
            DB::rollBack();
            return $this->fatalError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateCampaignRequest $request
     * @param Campaign $campaign
     * @return JsonResponse
     */
    public function update(CreateCampaignRequest $request, Campaign $campaign): JsonResponse
    {
        $campaign = $this->campaignService->updateCampaign($request->validated(), $campaign);
        return $this->success($campaign, Lang::get('operation.update'));
    }
}
