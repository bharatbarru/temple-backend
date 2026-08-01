<?php

namespace App\Http\Controllers\API\ApplicationSettings;

use App\Http\Requests\API\CreateApplicationSettingTypeAPIRequest;
use App\Http\Requests\API\UpdateApplicationSettingTypeAPIRequest;
use App\Models\ApplicationSettingType;
use App\Repositories\ApplicationSettingTypeRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class ApplicationSettingTypeController
 */

class ApplicationSettingTypeAPIController extends AppBaseController
{
    private ApplicationSettingTypeRepository $applicationSettingTypeRepository;

    public function __construct(ApplicationSettingTypeRepository $applicationSettingTypeRepo)
    {
        $this->applicationSettingTypeRepository = $applicationSettingTypeRepo;
    }

    /**
     * @OA\Get(
     *      path="/applicationSettingTypes",
     *      summary="getApplicationSettingTypeList",
     *      tags={"ApplicationSettingType"},
     *      description="Get all ApplicationSettingTypes",
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
     *                  @OA\Items(ref="#/components/schemas/ApplicationSettingType")
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
        $applicationSettingTypes = $this->applicationSettingTypeRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($applicationSettingTypes->toArray(), 'Application Setting Types retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/applicationSettingTypes",
     *      summary="createApplicationSettingType",
     *      tags={"ApplicationSettingType"},
     *      description="Create ApplicationSettingType",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ApplicationSettingType")
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
     *                  ref="#/components/schemas/ApplicationSettingType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateApplicationSettingTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $applicationSettingType = $this->applicationSettingTypeRepository->create($input);

        // Log Activity
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['name' => $request->type])
            ->log('API / Application Settings / Types - New type created.');

        return $this->sendResponse($applicationSettingType->toArray(), 'Application Setting Type saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/applicationSettingTypes/{id}",
     *      summary="getApplicationSettingTypeItem",
     *      tags={"ApplicationSettingType"},
     *      description="Get ApplicationSettingType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ApplicationSettingType",
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
     *                  ref="#/components/schemas/ApplicationSettingType"
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
        /** @var ApplicationSettingType $applicationSettingType */
        $applicationSettingType = $this->applicationSettingTypeRepository->find($id);

        if (empty($applicationSettingType)) {
            return $this->sendError('Application Setting Type not found');
        }

        return $this->sendResponse($applicationSettingType->toArray(), 'Application Setting Type retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/applicationSettingTypes/{id}",
     *      summary="updateApplicationSettingType",
     *      tags={"ApplicationSettingType"},
     *      description="Update ApplicationSettingType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ApplicationSettingType",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/ApplicationSettingType")
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
     *                  ref="#/components/schemas/ApplicationSettingType"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateApplicationSettingTypeAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var ApplicationSettingType $applicationSettingType */
        $applicationSettingType = $this->applicationSettingTypeRepository->find($id);

        if (empty($applicationSettingType)) {
            return $this->sendError('Application Setting Type not found');
        }

        $applicationSettingType = $this->applicationSettingTypeRepository->update($input, $id);

        // Log Activity
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['name' => $request->type])
            ->log('API / Application Settings / Types - type details updated.');

        return $this->sendResponse($applicationSettingType->toArray(), 'ApplicationSettingType updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/applicationSettingTypes/{id}",
     *      summary="deleteApplicationSettingType",
     *      tags={"ApplicationSettingType"},
     *      description="Delete ApplicationSettingType",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of ApplicationSettingType",
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
        /** @var ApplicationSettingType $applicationSettingType */
        $applicationSettingType = $this->applicationSettingTypeRepository->find($id);

        if (empty($applicationSettingType)) {
            return $this->sendError('Application Setting Type not found');
        }

        try {
            $applicationSettingType->delete();

            // Log Activity
            activity()
                ->performedOn(getAPIUser())
                ->withProperties(['name' => $applicationSettingType->type])
                ->log('API / Application Settings / Types - type details removed.');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendError('Cannot delete record because it has related records in another table.');
        }

        return $this->sendSuccess('Application Setting Type deleted successfully');
    }
}
