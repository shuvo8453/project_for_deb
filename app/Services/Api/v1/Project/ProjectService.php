<?php

namespace App\Services\Api\v1\Project;

use App\Http\Resources\Api\v1\Project\ProjectResource;
use Exception;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Joy2362\ServiceGenerator\Helper\ApiHelper;

class ProjectService
{
    /**
     * @var Collection
     */
    private Collection $collection;
    /**
     * @var string
     */
    private string $resource = "Project";

    /**
     * @inheritDoc
     */
    public function index(Request $request): Collection
    {
        $query = Project::query();
        $query->nameLike($request->name);
        $query->orderBy('id', 'desc');
        return ApiHelper::success([
            'data' => $request->all ? $query->get() : $query->paginate($request->input('per_page', 10))
        ]);
    }

    /**
     * @inheritDoc
     */
    public function store(Request $request): Collection
    {
        try {
            $data = $request->validated();

            $project = $request->user()->project()->create($data);

            $this->collection = ApiHelper::success([
                'message' => __('ApiHelper::crud.create', ['resource' => $this->resource]),
                'project' => new ProjectResource($project)
            ]);
        } catch (Exception $ex) {
            Log::channel('project_service')->debug($ex->getMessage());
            $this->collection = ApiHelper::failed(['errors' => [$this->resource => [__('errors.error')]]]);
        }
        return $this->collection;
    }

    /*
   |--------------------------------------------------------------------------
   | class internal methods
   |--------------------------------------------------------------------------
   |
   */
}
