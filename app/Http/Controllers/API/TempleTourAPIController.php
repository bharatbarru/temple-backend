<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTempleTourAPIRequest;
use App\Http\Requests\API\UpdateTempleTourAPIRequest;
use App\Models\TempleTour;
use App\Repositories\TempleTourRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TempleTourResource;
use App\Mail\AdminTourRequestMail;
use App\Mail\UserTourRequestMail;
use App\Models\OrderStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

/**
 * Class TempleTourController
 */

class TempleTourAPIController extends AppBaseController
{
    /** @var  TempleTourRepository */
    private $templeTourRepository;

    public function __construct(TempleTourRepository $templeTourRepo)
    {
        $this->templeTourRepository = $templeTourRepo;
    }

    /**
     * @OA\Get(
     *      path="/templeTours",
     *      summary="getTempleTourList",
     *      tags={"TempleTour"},
     *      description="Get all TempleTours",
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
     *                  @OA\Items(ref="#/components/schemas/TempleTour")
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
        $templeTours = $this->templeTourRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TempleTourResource::collection($templeTours), 'Temple Tours retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/templeTours",
     *      summary="createTempleTour",
     *      tags={"TempleTour"},
     *      description="Create TempleTour",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/TempleTour")
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
     *                  ref="#/components/schemas/TempleTour"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTempleTourAPIRequest $request): JsonResponse
    {
        // Create the temple tour
        $templeTour = $this->templeTourRepository->create($request->all());

        OrderStatus::create([
            'temple_tour_order_id' => $templeTour->id,
            'status' => NEW_REQUEST,
        ]);

        // Send emails to both admin and user
        if (app()->environment('production')) {
            try {
                // Admin email
               
                Mail::to(applicationSettings('templetour-email'))->send(new AdminTourRequestMail($templeTour));

                // User email
                Mail::to($templeTour->email)->send(new UserTourRequestMail($templeTour));
            } catch (\Exception $e) {
                \Log::error("Email sending failed: " . $e->getMessage());
            }
        }

        $data = [
            'tour_request_id' => $templeTour->tour_request_id,
        ];

        // Return response
        return $this->sendResponse($data, 'Temple Tour saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/templeTours/{id}",
     *      summary="getTempleTourItem",
     *      tags={"TempleTour"},
     *      description="Get TempleTour",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TempleTour",
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
     *                  ref="#/components/schemas/TempleTour"
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
        /** @var TempleTour $templeTour */
        $templeTour = $this->templeTourRepository->find($id);

        if (empty($templeTour)) {
            return $this->sendError('Temple Tour not found');
        }

        return $this->sendResponse(new TempleTourResource($templeTour), 'Temple Tour retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/templeTours/{id}",
     *      summary="updateTempleTour",
     *      tags={"TempleTour"},
     *      description="Update TempleTour",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TempleTour",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/TempleTour")
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
     *                  ref="#/components/schemas/TempleTour"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTempleTourAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var TempleTour $templeTour */
        $templeTour = $this->templeTourRepository->find($id);

        if (empty($templeTour)) {
            return $this->sendError('Temple Tour not found');
        }

        $templeTour = $this->templeTourRepository->update($input, $id);

        return $this->sendResponse(new TempleTourResource($templeTour), 'TempleTour updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/templeTours/{id}",
     *      summary="deleteTempleTour",
     *      tags={"TempleTour"},
     *      description="Delete TempleTour",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TempleTour",
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
        /** @var TempleTour $templeTour */
        $templeTour = $this->templeTourRepository->find($id);

        if (empty($templeTour)) {
            return $this->sendError('Temple Tour not found');
        }

        $templeTour->delete();

        return $this->sendSuccess('Temple Tour deleted successfully');
    }
}
