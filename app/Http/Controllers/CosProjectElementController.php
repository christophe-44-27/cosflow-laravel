<?php

namespace App\Http\Controllers;

use App\Http\Requests\CosProjectRequest;
use App\Resources\CosProjectElementResource;
use App\Resources\CosProjectResource;
use App\Models\CosProject;
use App\Models\CosProjectElement;
use App\Models\CreatedElement;
use App\Models\PurchasedElement;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CosProjectElementController extends Controller
{
    /**
     * @param CosProject $project
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listByProject(CosProject $project)
    {
        return CosProjectElementResource::collection($project->cosElements);
    }

    /**
     * @param Request $request
     * @param CosProject $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, CosProject $project, FileUploadService $fileUploadService)
    {
        $cosProjectElement = new CosProjectElement();

        $data = [
            'name' => $request->get('name')
        ];

        if ($request->get('elementable_type') == 'App\Models\CreatedElement') {
            $createdElement = new CreatedElement();
            $createdElementData = [
                'hours_spent' => $request->get('hours_spent'),
                'minutes_spent' => $request->get('minutes_spent'),
                'percentage_of_progression' => $request->get('percentage_of_progression'),
                'element_picture' => $request->get('element_picture'),
                'comment' => $request->get('comment'),
            ];

            if($request->file('element_picture')) {
                $imageProjectElementPath = $fileUploadService->uploadS3(
                    $request->file('element_picture'), 150,150, 'images/projects/' . Str::slug($project->owner->name) . '/' . Str::slug($project->character_name) . '/elements'
                );

                $createdElementData['element_picture'] = $imageProjectElementPath;
            }

            $createdElement = $createdElement->create($createdElementData);
            $data['elementable_type'] = 'App\Models\CreatedElement';
            $data['elementable_id'] = $createdElement->id;
        } else {
            $purchasedElement = new PurchasedElement();
            $purchasedElementData = [
                'cost' => $request->get('cost'),
                'is_ready' => $request->get('is_ready'),
                'element_picture' => $request->get('element_picture'),
                'comment' => $request->get('comment'),
            ];

            if($request->file('element_picture')) {
                $imageProjectElementPath = $fileUploadService->uploadS3(
                    $request->file('element_picture'), 150,150, 'images/projects/' . Str::slug($project->owner->name) . '/' . Str::slug($project->character_name) . '/elements'
                );

                $purchasedElementData['element_picture'] = $imageProjectElementPath;
            }

            $purchasedElement = $purchasedElement->create($purchasedElementData);

            $data['elementable_type'] = 'App\Models\PurchasedElement';
            $data['elementable_id'] = $purchasedElement->id;
        }
        $cosProjectElement = $cosProjectElement->create($data);
        $project->cosElements()->sync($cosProjectElement);

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
