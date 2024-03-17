<?php

namespace App\Http\Controllers\Api\v1\Project;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Joy2362\ServiceGenerator\Helper\ApiHelper;
use App\Services\Api\v1\Project\ProjectService;
use App\Http\Requests\Api\v1\Project\ProjectRequest;

class ProjectController extends Controller
{
    public function __construct(public ProjectService $service)
    {
    }

    /**
     * Gel all project list
     * @OA\Get(
     *     path="/api/v1/project",
     *     tags={"Project"},
     *     summary="Get all project",
     *     security={{"sanctum":{}}},
     *     operationId="projectIndex",
     *     @OA\Parameter(
     *         in="query",
     *         name="code",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="per_page",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="all",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operation Successful ",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="json", example={})
     *          )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid request",
     *           @OA\JsonContent(
     *              @OA\Property(property="errors", type="json", example={})
     *          )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Invalid request",
     *           @OA\JsonContent(
     *              @OA\Property(property="errors", type="json", example={})
     *          )
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        return ApiHelper::response($this->service->index($request));
    }

    /**
     * Project Store
     * @OA\Post (
     *     path="/api/v1/project",
     *     tags={"Project"},
     *     summary="Project Store",
     *     security={{"sanctum":{}}},
     *     operationId="storeProject",
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass project data",
     *    @OA\JsonContent(
     *       required={
     *          "name","code"
     *      },
     *       @OA\Property(property="name", type="string", example="general"),
     *       @OA\Property(property="code", type="string",  example="code"),
     *    ),
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="Operation Successful",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="json", example={}),
     *          )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid request",
     *           @OA\JsonContent(
     *              @OA\Property(property="error", type="json", example={}),
     *          )
     *     ),
     * )
     */
    public function store(ProjectRequest $request): JsonResponse
    {
        return ApiHelper::response($this->service->store($request));
    }
}
