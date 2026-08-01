<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSliderAPIRequest;
use App\Http\Requests\API\UpdateSliderAPIRequest;
use App\Models\Slider;
use App\Repositories\SliderRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\SliderResource;

/**
 * Class SliderController
 */

class SliderAPIController extends AppBaseController
{
    /** @var  SliderRepository */
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepository = $sliderRepo;
    }

    /**
     * @OA\Get(
     *      path="/sliders",
     *      summary="getSliderList",
     *      tags={"Slider"},
     *      description="Get all Sliders",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(ref="#/components/schemas/Slider")
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $sliders = $this->sliderRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        foreach ($sliders as $slider) {
            if (!empty($slider->image)) {
                $slider->image = url(SLIDER_IMAGE_PATH . $slider->image);
            }
        }

        return $this->sendResponse($sliders->toArray(), 'Sliders retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/sliders",
     *      summary="createSlider",
     *      tags={"Slider"},
     *      description="Create Slider",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Slider")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Slider"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSliderAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $slider = $this->sliderRepository->create($input);
        if ($request->hasfile('image')) {
            $slider->image = uploadImageAPI($request->file('image'), SLIDER_IMAGE_PATH);
        }
        $slider->save();

        // Log Activity
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['image' => $slider->image, 'title' => $slider->title])
            ->log('API / Slider - New slider created.');

        return $this->sendResponse(new SliderResource($slider), 'Slider saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/sliders/{id}",
     *      summary="getSliderItem",
     *      tags={"Slider"},
     *      description="Get Slider",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Slider",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Slider"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id): JsonResponse
    {
        /** @var Slider $slider */
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            return $this->sendError('Slider not found');
        }

        return $this->sendResponse(new SliderResource($slider), 'Slider retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/sliders/{id}",
     *      summary="updateSlider",
     *      tags={"Slider"},
     *      description="Update Slider",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Slider",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Slider")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/Slider"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSliderAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Slider $slider */
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            return $this->sendError('Slider not found');
        }

        if ($request->hasfile('image')) {
            removeImage($slider->image, SLIDER_IMAGE_PATH);
        }
        $slider = $this->sliderRepository->update($input, $id);

        if ($request->hasfile('image')) {
            $slider->image = uploadImageAPI($request->file('image'), SLIDER_IMAGE_PATH);
        }
        $slider->save();

        // Log Activity
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['image' => $slider->image, 'title' => $slider->title])
            ->log('API / Slider - Slider details updated.');

        return $this->sendResponse(new SliderResource($slider), 'Slider updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/sliders/{id}",
     *      summary="deleteSlider",
     *      tags={"Slider"},
     *      description="Delete Slider",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Slider",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id): JsonResponse
    {
        /** @var Slider $slider */
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            return $this->sendError('Slider not found');
        }

        if (!empty($slider->image)) {
            removeImage($slider->image, SLIDER_IMAGE_PATH);
        }
        $slider->delete();

        // Log Activity
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['image' => $slider->image, 'title' => $slider->title])
            ->log('API / Slider - slider details removed.');

        return $this->sendSuccess('Slider deleted successfully');
    }
}
