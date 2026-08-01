<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateServiceAPIRequest;
use App\Http\Requests\API\UpdateServiceAPIRequest;
use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\ServiceResource;
use App\Models\ServiceCategory;

/**
 * Class ServiceController
 */

class ServiceAPIController extends AppBaseController
{
    /** @var  ServiceRepository */
    private $serviceRepository;

    public function __construct(ServiceRepository $serviceRepo)
    {
        $this->serviceRepository = $serviceRepo;
    }

    /**
     * @OA\Get(
     *      path="/services",
     *      summary="getServiceList",
     *      tags={"Service"},
     *      description="Get all Services",
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
     *                  @OA\Items(ref="#/components/schemas/Service")
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
        $services = $this->serviceRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(ServiceResource::collection($services), 'Services retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/services",
     *      summary="createService",
     *      tags={"Service"},
     *      description="Create Service",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Service")
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
     *                  ref="#/components/schemas/Service"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateServiceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $service = $this->serviceRepository->create($input);
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['image' => $service->image])
            ->log('Service - New Service created.');

        return $this->sendResponse(new ServiceResource($service), 'Service saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/services/{id}",
     *      summary="getServiceItem",
     *      tags={"Service"},
     *      description="Get Service",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Service",
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
     *                  ref="#/components/schemas/Service"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($slug): JsonResponse
    {
        /** @var Service $service */
        $serviceCategory = ServiceCategory::where('slug', $slug)->first();

        if (empty($serviceCategory)) {
            return $this->sendError('Service not found');
        }

        $services = Service::where('service_category_id', $serviceCategory->id)
                                ->where('publish', 1)
                                ->orderBy('sort')
                                ->get()
                                ->makeHidden(['id', 'service_category_id','publish', 'created_at', 'updated_at']);

        return $this->sendResponse($services->toArray(), 'Service retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/services/{id}",
     *      summary="updateService",
     *      tags={"Service"},
     *      description="Update Service",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Service",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Service")
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
     *                  ref="#/components/schemas/Service"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateServiceAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Service $service */
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            return $this->sendError('Service not found');
        }

        $service = $this->serviceRepository->update($input, $id);

        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['image' => $service->image])
            ->log('Service -  Service name updated.');

        return $this->sendResponse(new ServiceResource($service), 'Service updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/services/{id}",
     *      summary="deleteService",
     *      tags={"Service"},
     *      description="Delete Service",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Service",
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
        /** @var Service $service */
        $service = $this->serviceRepository->find($id);

        if (empty($service)) {
            return $this->sendError('Service not found');
        }

        try {
            $service->delete();

            activity()
                ->performedOn(getAPIUser())
                ->withProperties(['image' => $service->image])
                ->log('Service - Service removed.');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendSuccess('Service deleted successfully');
        }
    }
}