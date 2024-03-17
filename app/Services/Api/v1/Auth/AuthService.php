<?php

namespace App\Services\Api\v1\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Joy2362\ServiceGenerator\Helper\ApiHelper;
use App\Http\Resources\Api\v1\Auth\UserResource;
use Illuminate\Support\{Facades\Log, Facades\Auth, Collection, Arr};

class AuthService
{
    private Collection $collection;


    /**
     * @param Request $request
     * @return Collection
     */
    public function login(Request $request): Collection
    {
        try {
            $data = $request->validated();
            if (Auth::guard('web')->attempt(Arr::except($data, ['remember']))) {
                $this->collection = ApiHelper::success($this->loginData($request->validated('email'), $request->validated('remember')));
            } else {
                $this->collection = ApiHelper::failed([
                    'error' => __('auth.failed')
                ], 401);
            }
        } catch (Exception $ex) {
            Log::channel('auth_service')->debug($ex->getMessage());
            $this->collection = ApiHelper::failed([
                'errors' => ['auth' => [__('errors.error')]]
            ]);
        }
        return $this->collection;
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function logout(Request $request): Collection
    {
        try {
            $this->collection = $request->user()->currentAccessToken()->delete() ?
                ApiHelper::success(['message' => __('auth.logout')])
                : ApiHelper::failed([
                    'errors' => ['auth' => [__('auth.Unauthenticated')]]
                ]);
        } catch (Exception $ex) {
            Log::channel('auth_service')->debug($ex->getMessage());
            $this->collection = ApiHelper::failed([
                'errors' => ['auth' => [__('errors.error')]]
            ]);
        }
        return $this->collection;
    }

    /**
     * @param Request $request
     * @return Collection
     */
    public function registration(Request $request): Collection
    {
        try {
            $data = $this->setRegistrationData($request->validated());
            $user = User::create($data);
            $user->refresh();
            $this->collection = ApiHelper::success([
                'message' => __('auth.registration.success'),
                'profile' => new UserResource($user),
                'access_token' => $this->generateAuthToken($user),
            ]);
        } catch (Exception $ex) {
            Log::channel('auth_service')->debug($ex->getMessage());
            $this->collection = ApiHelper::failed([
                'errors' => ['auth' => [__('errors.error')]]
            ]);
        }
        return $this->collection;
    }

    public function createTeamMember(Request $request): Collection
    {
        try {
            $data = $this->setRegistrationData($request->validated());
            $user = User::create($data);

            $this->collection = ApiHelper::success([
                'message' => __('ApiHelper::crud.create', ['resource' => 'Team mate']),
                'profile' => new UserResource($user),
            ]);
        } catch (Exception $ex) {
            Log::channel('auth_service')->debug($ex->getMessage());
            $this->collection = ApiHelper::failed([
                'errors' => ['auth' => [__('errors.error')]]
            ]);
        }
        return $this->collection;
    }
    /*
    |
    |--------------------------------------------------------------------------
    | class internal methods
    |--------------------------------------------------------------------------
    |
    */

    /**
     * @param $email
     * @param null $remember
     * @param null $message
     * @return array
     */
    private function loginData($email, $remember = null, $message = null): array
    {
        $user = auth()->user();
        return [
            'message' => $message ?? __('auth.success'),
            'profile' => new UserResource($user),
            'access_token' => $this->generateAuthToken($user, $remember),
        ];
    }

    /**
     * @param $user
     * @param null $remember
     * @return mixed
     */
    private function generateAuthToken(
        $user,
        $remember = null
    ): mixed {
        if ($user->position == 'manager') {
            $role = ["role:{$user->position}"];
        } else {
            $role = ["role:teammate"];
        }

        if ($remember) {
            $role[] = 'remember';
        }
        return $user->createToken('token', $role)->plainTextToken;
    }

    /**
     * @param $request
     * @return array
     */
    public function setRegistrationData(
        $request
    ): array {
        $data = collect($request)->except(['password'])->toArray();
        $data['password'] = Hash::make($request['password']);
        return $data;
    }
}
