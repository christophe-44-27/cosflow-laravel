<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\CosProject;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listGroup(Request $request)
    {
        if ($request->get('my_groups') != 0)
        {
            $user = Auth::user();
            $groups = Group::where('owner_id', '=', $user->id)->paginate(getenv('LIMIT_PAGINATION_RESULT'));
        } else
        {
            $groups = Group::orderBy('id', 'DESC')->paginate(getenv('LIMIT_PAGINATION_RESULT'));
        }

        return $groups;
    }

    /**
     * @param GroupRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(GroupRequest $request)
    {
        $group = new Group();

        $datas = [
            'name' => $request->get('name'),
            'group_code' => $this->generateRandomString(5),
            'owner_id' =>  Auth::id(),
        ];

        $group->create($datas);

        return response()->json([
            'message' => trans('cos_projects.group_created'),
        ]);
    }

    /**
     * @param Group $group
     * @return GroupResource
     */
    public function show(Group $group)
    {
        return GroupResource::make($group);
    }

    /**
     * @param GroupRequest $request
     * @param Group $group
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->all());

        return response()->json([
            'group_name' => $group->name,
            'message' => trans('cos_projects.update_succeed'),
        ]);
    }

    /**
     * @param string $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function join(string $code)
    {
        $group = Group::where('group_code', '=', $code)->first();

        if ($group)
        {
            $userConnected = Auth::user();

            if ($userConnected->id != $group->owner_id)
            {
                $group->users()->sync($userConnected);

                return response()->json([
                    'error' => true,
                    'message' => trans('cos_projects.group_joined', ['%s' => $group->name]),
                ]);

            } else
            {
                return response()->json([
                    'error' => true,
                    'message' => trans('cos_projects.you_are_the_owner_of_the_group'),
                ]);
            }

        } else
        {
            return response()->json([
                'error' => true,
                'message' => trans('cos_projects.group_code_invalid'),
            ]);
        }
    }

    /**
     * @param Group $group
     * @param CosProject $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function attachProject(Group $group, CosProject $project)
    {
        $group->projects()->sync($project);

        return response()->json([
            'group_name' => $group->name,
            'project_name' => $project->character_name,
            'message' => trans('cos_projects.project_added_to_the_group'),
        ]);
    }

    /**
     * @param Group $group
     * @param CosProject $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function detach(Group $group, CosProject $project)
    {
        if($group->projects) {
            $group->projects()->detach($project);

            return response()->json([
                'group_name' => $group->name,
                'project_name' => $project->character_name,
                'message' => trans('cos_projects.project_remove_from_group'),
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => trans('cos_projects.group_has_no_projects'),
            ]);
        }
    }

    /**
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 10):string {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
