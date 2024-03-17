<?php

namespace App\Services\Api\v1\Task;

use Exception;
use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Joy2362\ServiceGenerator\Helper\ApiHelper;
use App\Http\Resources\Api\v1\Task\TaskResource;

class TaskService
{
    /**
     * @var Collection
     */
    private Collection $collection;
    /**
     * @var string
     */
    private string $resource = "Task";

    /**
     * @inheritDoc
     */
    public function index(Request $request): Collection
    {
        $query = Task::query();
        $query->byTeamMembers($request->teamMembers);
        $query->byProject($request->project);
        $query->byStatus($request->status);
        $query->with(['users' => function ($q) {
            $q->whereNotIn('position', ['manager']);
        }]);
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
            $task = Task::create($data);
            $task->users()->attach($request->validated('user_id'));
            $this->collection = ApiHelper::success([
                'message' => __('ApiHelper::crud.create', ['resource' => $this->resource]),
                'task' => new TaskResource($task)
            ]);
        } catch (Exception $ex) {
            Log::channel('task_service')->debug($ex->getMessage());
            $this->collection = ApiHelper::failed(['errors' => $ex->getMessage()]);
        }
        return $this->collection;
    }

    public function assignTask($id, Request $request)
    {
        try {
            if ($task = Task::find($id)) {
                $users = $request->validated('user_id');
                $task->users()->sync($users);
                $this->collection = ApiHelper::success([
                    'message' => __('ApiHelper::crud.update', ['resource' => $this->resource])
                ]);
            } else {
                $this->collection = ApiHelper::failed([
                    'errors' => [$this->resource => [__('ApiHelper::crud.notFound', ['resource' => $this->resource])]]
                ]);
            }
        } catch (Exception $ex) {
            Log::channel('task_service')->debug($ex->getMessage());
            $this->collection = ApiHelper::failed([
                'errors' => [$this->resource => [__('errors.error')]]
            ]);
        }
        return $this->collection;
    }

    public function getAssignTask(Request $request)
    {
        $query = Task::query();
        $query->byTeamMembers([$request->user()->id]);
        $query->byProject($request->project);
        $query->byStatus($request->status);
        $query->with('users:id,name,employee_id');
        $query->orderBy('id', 'desc');
        return ApiHelper::success([
            'data' => $request->all ? $query->get() : $query->paginate($request->input('per_page', 10))
        ]);
    }

    public function upateTaskStatus($id, Request $request)
    {
        try {
            if ($task = Task::find($id)) {
                $data['status'] = $request->validated('status');
                $task->update($data);
                $this->collection = ApiHelper::success([
                    'message' => __('ApiHelper::crud.update', ['resource' => $this->resource])
                ]);
            } else {
                $this->collection = ApiHelper::failed([
                    'errors' => [$this->resource => [__('ApiHelper::crud.notFound', ['resource' => $this->resource])]]
                ]);
            }
        } catch (Exception $ex) {
            Log::channel('task_service')->debug($ex->getMessage());
            $this->collection = ApiHelper::failed([
                'errors' => [$this->resource => [__('errors.error')]]
            ]);
        }
        return $this->collection;
    }

    public function getProjectList(Request $request)
    {
        return ApiHelper::success([
            'project' => Project::get() ?? []
        ]);
    }

    public function getTeamMate(Request $request)
    {
        return ApiHelper::success([
            'teammate' => User::whereNotIn('position', ['manager'])->get() ?? []
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | class internal methods
    |--------------------------------------------------------------------------
    |
    */
}
