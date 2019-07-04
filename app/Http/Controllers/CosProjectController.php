<?php

namespace App\Http\Controllers;

use App\Http\Requests\CosProjectRequest;
use App\Resources\CosProjectResource;
use App\Models\CosProject;
use App\Models\CreatedElement;
use App\Models\PurchasedElement;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CosProjectController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $userProjects = CosProject::where('owner_id', '=', Auth::id())
            ->get();

        return CosProjectResource::collection($userProjects);
    }

    /**
     * @param CosProjectRequest $request
     * @param FileUploadService $fileUploadService
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CosProjectRequest $request, FileUploadService $fileUploadService)
    {
        $project = new CosProject();

        $data = [
            'character_name' => $request->get('character_name'),
            'serie_name' => $request->get('serie_name'),
            'starting_date' => $request->get('starting_date'),
            'due_date' => $request->get('due_date'),
            'estimated_budget' => $request->get('estimated_budget'),
            'is_planned' => ($request->get('is_planned')) ? $request->get('is_planned') : false,
            'is_processing' => ($request->get('is_processing')) ? $request->get('is_processing') : true,
            'is_private' => ($request->get('is_private')) ? $request->get('is_private') : true,
            'owner_id' =>  Auth::id(),
        ];

        if($request->file('image_project')) {
            $imageProjectPath = $fileUploadService->uploadS3(
                $request->file('image_project'), 150,150, 'images/projects/' . Str::slug(Auth::user()->name) . '/' . Str::slug($request->get('character_name'))
            );

            $data['image_project'] = $imageProjectPath;
        }

        $project->create($data);


        return response()->json([
            'message' => trans('cos_projects.update_succeed'),
        ]);
    }

    /**
     * @param CosProject $project
     * @return CosProjectResource
     */
    public function show(CosProject $project)
    {
        return CosProjectResource::make($project);
    }

    /**
     * @param CosProjectRequest $request
     * @param CosProject $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CosProjectRequest $request, CosProject $project)
    {
        $project->update($request->all());

        return response()->json([
            'cos_project_name' => $project->character_name,
            'message' => trans('cos_projects.update_succeed'),
        ]);
    }

    /**
     * @param CosProject $project
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete(CosProject $project)
    {
        if ($project->cosElements)
        {
            foreach ($project->cosElements as $cosElement)
            {
                $createdElement = CreatedElement::where('id', '=', $cosElement->elementable_id)
                    ->first();

                $purchasedElement = PurchasedElement::where('id', '=', $cosElement->elementable_id)
                    ->first();

                if ($createdElement && $createdElement->count() > 0)
                {
                    $createdElement->delete();
                }

                if ($purchasedElement && $purchasedElement->count() > 0)
                {
                    $purchasedElement->delete();
                }
            }
            $project->cosElements()->delete();
        }

        $project->delete();

        return response()->json([
            'cos_project_name' => $project->character_name,
            'message' => trans('cos_projects.update_succeed'),
        ]);
    }
}
