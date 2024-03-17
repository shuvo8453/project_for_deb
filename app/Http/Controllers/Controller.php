<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      x={
 *          "logo": {
 *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
 *          }
 *      },
 *      title="Bulk-ly ",
 *      description="Bulk-ly v-2 Swagger api documentation",
 *      @OA\Contact(
 *          email="bulk-ly@test.com"
 *      ),
 * ),
 *   @OA\SecurityScheme(
 *     type="http",
 *     description="Login with email and password to get the authentication token",
 *     name="Token based Based",
 *     in="header",
 *     scheme="bearer",
 *     securityScheme="sanctum",
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
}
