<?php

namespace App\Http\Controllers\Api\v1\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Task\{AssignTaskRequest, UpdateTaskStatusRequest};
use App\Services\Api\v1\Task\TaskService;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\Api\v1\Task\TaskRequest;
use Joy2362\ServiceGenerator\Helper\ApiHelper;

class TaskController extends Controller
{
    public function __construct(public TaskService $service)
    {
    }

    /**
     * Gel all project list
     * @OA\Get(
     *     path="/api/v1/task",
     *     tags={"Task"},
     *     summary="Get all task",
     *     security={{"sanctum":{}}},
     *     operationId="taskIndex",
     *     @OA\Parameter(
     *         in="query",
     *         name="teamMembers[]",
     *         required=false,
     *         @OA\Schema(type="array" , @OA\Items(type="integer" ,example="1"))
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="project",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="status",
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
     * Task Store
     * @OA\Post (
     *     path="/api/v1/task",
     *     tags={"Task"},
     *     summary="task Store",
     *     security={{"sanctum":{}}},
     *     operationId="storeTask",
     * @OA\RequestBody(
     *    required=true,
     *    description="Pass project data",
     *    @OA\JsonContent(
     *       required={
     *          "name","project_code"
     *      },
     *       @OA\Property(property="name", type="string", example="general"),
     *       @OA\Property(property="project_code", type="string",  example="code"),
     *       @OA\Property(property="description", type="string",  example="description"),
     *       @OA\Property(property="status", type="string",  example="pending"),
     *      @OA\Property(property="user_id", type="array", @OA\Items(type="integer" ,example="1")),
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
    public function store(TaskRequest $request): JsonResponse
    {
        return ApiHelper::response($this->service->store($request));
    }
    /**
     * Task assign
     * @OA\Post (
     *     path="/api/v1/assign-task/{id}",
     *     tags={"Task"},
     *     summary="task assign",
     *     security={{"sanctum":{}}},
     *     operationId="assignTask",
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="number"),
     *         example="1"
     *     ),
     *    @OA\RequestBody(
     *    required=true,
     *    description="Pass task data",
     *    @OA\JsonContent(
     *       required={
     *          "user_id"
     *      },
     *      @OA\Property(property="user_id", type="array", @OA\Items(type="integer" ,example="1")),
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
    public function assignTask($id, AssignTaskRequest $request): JsonResponse
    {
        return ApiHelper::response($this->service->assignTask($id, $request));
    }

    /**
     * Gel all project list
     * @OA\Get(
     *     path="/api/v1/get/assign-task",
     *     tags={"Task"},
     *     summary="Get all get assign-task",
     *     security={{"sanctum":{}}},
     *     operationId="/get/assign-task",
     *     @OA\Parameter(
     *         in="query",
     *         name="project",
     *         required=false,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="status",
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
    public function getAssignTask(Request $request): JsonResponse
    {
        return ApiHelper::response($this->service->getAssignTask($request));
    }

    public function upateTaskStatus($id, UpdateTaskStatusRequest $request): JsonResponse
    {
        return ApiHelper::response($this->service->upateTaskStatus($id, $request));
    }

    public function getProjectList(Request $request)
    {
        return ApiHelper::response($this->service->getProjectList($request));
    }

    public function getTeamMate(Request $request)
    {
        return ApiHelper::response($this->service->getTeamMate($request));
    }
}
