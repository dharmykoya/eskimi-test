<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCampaignRequest;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use App\Services\CampaignService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;

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
     * Store a newly created resource in storage.
     *
     * @param CreateCampaignRequest $request
     * @return JsonResponse
     */
    public function store(CreateCampaignRequest $request): JsonResponse
    {
        $campaign = $this->campaignService->createCampaign($request->validated());
        return $this->success(new CampaignResource($campaign), Lang::get('operation.store'), Response::HTTP_CREATED);
    }
}
