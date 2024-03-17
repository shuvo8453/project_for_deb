<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Services\Api\v1\Auth\AuthService;
use Illuminate\Http\{Request, JsonResponse};
use Joy2362\ServiceGenerator\Helper\ApiHelper;
use App\Http\Requests\Api\v1\Auth\LoginRequest;
use App\Http\Resources\Api\v1\Auth\UserResource;
use App\Http\Requests\Api\v1\Auth\RegistationRequest;
use App\Http\Requests\Api\v1\Auth\TeamMemberCreateRequest;

class AuthController extends Controller
{
    public function __construct(public AuthService $service)
    {
    }

    /**
     *  login user
     * @OA\Post(
     *      path="/api/v1/login",
     *      tags={"Auth"},
     *      summary="Login user",
     *      description="The process of gaining access to a website by providing valid credentials.",
     *      operationId="login",
     *      @OA\RequestBody(
     *      required=true,
     *      description="Pass user data",
     *          @OA\JsonContent(
     *              required={"email" , "password"},
     *              @OA\Property(property="email", type="email", example="abdullahzahidjoy@gmail.com"),
     *              @OA\Property(property="password", type="password", example="password"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Invalid input",
     *          @OA\JsonContent(
     *              @OA\Property(property="errors", type="json", example={}),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="Success", type="json", example={}),
     *          )
     *      ),
     *  )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return ApiHelper::response($this->service->login($request));
    }

    /**
     * Logout user
     * @OA\Get(
     *     path="/api/v1/logout",
     *     tags={"Auth"},
     *     summary="Logout user",
     *     description="The process of ending a user session in a website effectively logging the user out of their account.",
     *     security={{"sanctum":{}}},
     *     operationId="logout",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
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
    public function logout(Request $request): JsonResponse
    {
        return ApiHelper::response($this->service->logout($request));
    }

    /**
     * get user profile
     * @OA\Get(
     *     path="/api/v1/me",
     *     tags={"Auth"},
     *     summary="Get User Profile",
     *     description="This API can be used to retrieve user profile data from the system.",
     *     security={{"sanctum":{}}},
     *     operationId="me",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
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
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'profile' => new UserResource($request->user()),
        ]);
    }


    /**
     * registration
     * @OA\Post(
     *     path="/api/v1/registration",
     *     tags={"Auth"},
     *     summary="Collect user information and store it securely",
     *     description="The API can be used to collect user information and store it securely in a database.",
     *     operationId="registration",
     *     @OA\RequestBody(
     *     required=true,
     *     description="Pass user data",
     *     @OA\JsonContent(
     *      required={"email","name" , "employee_id", "password"},
     *      @OA\Property(property="email", type="email", example="test@test.com"),
     *      @OA\Property(property="name", type="string", example="test"),
     *      @OA\Property(property="employee_id", type="string", example="12345"),
     *      @OA\Property(property="password", type="password", example="password"),
     *      )
     * ),
     *        @OA\Response(
     *         response=422,
     *         description="Invalid request",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="json", example={}),
     *          )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="Success", type="json", example={}),
     *          )
     *     ),
     * )
     */
    public function registration(RegistationRequest $request): JsonResponse
    {
        return ApiHelper::response($this->service->registration($request));
    }

    /**
     * registration
     * @OA\Post(
     *     path="/api/v1/team-member/create",
     *     tags={"Auth"},
     *     summary="Collect user information and store it securely",
     *     description="The API can be used to collect user information and store it securely in a database.",
     *     operationId="team-member-create",
     *     @OA\RequestBody(
     *     required=true,
     *     description="Pass user data",
     *     @OA\JsonContent(
     *      required={"email","name" , "employee_id", "password"},
     *      @OA\Property(property="email", type="email", example="test@test.com"),
     *      @OA\Property(property="name", type="string", example="test"),
     *      @OA\Property(property="employee_id", type="string", example="12345"),
     *      @OA\Property(property="position", type="string", example="developer"),
     *      @OA\Property(property="password", type="password", example="password"),
     *      )
     * ),
     *        @OA\Response(
     *         response=422,
     *         description="Invalid request",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="json", example={}),
     *          )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Success",
     *          @OA\JsonContent(
     *              @OA\Property(property="Success", type="json", example={}),
     *          )
     *     ),
     * )
     */
    public function createTeamMember(TeamMemberCreateRequest $request): JsonResponse
    {
        return ApiHelper::response($this->service->createTeamMember($request));
    }
}
