<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTestimonialAPIRequest;
use App\Http\Requests\API\UpdateTestimonialAPIRequest;
use App\Models\Testimonial;
use App\Repositories\TestimonialRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TestimonialResource;

/**
 * Class TestimonialController
 */

class TestimonialAPIController extends AppBaseController
{
    /** @var  TestimonialRepository */
    private $testimonialRepository;

    public function __construct(TestimonialRepository $testimonialRepo)
    {
        $this->testimonialRepository = $testimonialRepo;
    }

    /**
     * @OA\Get(
     *      path="/testimonials",
     *      summary="getTestimonialList",
     *      tags={"Testimonial"},
     *      description="Get all Testimonials",
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
     *                  @OA\Items(ref="#/components/schemas/Testimonial")
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
        $testimonials = $this->testimonialRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TestimonialResource::collection($testimonials), 'Testimonials retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/testimonials",
     *      summary="createTestimonial",
     *      tags={"Testimonial"},
     *      description="Create Testimonial",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Testimonial")
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
     *                  ref="#/components/schemas/Testimonial"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTestimonialAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $testimonial = $this->testimonialRepository->create($input);

        return $this->sendResponse(new TestimonialResource($testimonial), 'Testimonial saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/testimonials/{id}",
     *      summary="getTestimonialItem",
     *      tags={"Testimonial"},
     *      description="Get Testimonial",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Testimonial",
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
     *                  ref="#/components/schemas/Testimonial"
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
        /** @var Testimonial $testimonial */
        $testimonial = $this->testimonialRepository->find($id);

        if (empty($testimonial)) {
            return $this->sendError('Testimonial not found');
        }

        return $this->sendResponse(new TestimonialResource($testimonial), 'Testimonial retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/testimonials/{id}",
     *      summary="updateTestimonial",
     *      tags={"Testimonial"},
     *      description="Update Testimonial",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Testimonial",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Testimonial")
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
     *                  ref="#/components/schemas/Testimonial"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTestimonialAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Testimonial $testimonial */
        $testimonial = $this->testimonialRepository->find($id);

        if (empty($testimonial)) {
            return $this->sendError('Testimonial not found');
        }

        $testimonial = $this->testimonialRepository->update($input, $id);

        return $this->sendResponse(new TestimonialResource($testimonial), 'Testimonial updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/testimonials/{id}",
     *      summary="deleteTestimonial",
     *      tags={"Testimonial"},
     *      description="Delete Testimonial",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Testimonial",
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
        /** @var Testimonial $testimonial */
        $testimonial = $this->testimonialRepository->find($id);

        if (empty($testimonial)) {
            return $this->sendError('Testimonial not found');
        }
    try{
        $testimonial->delete();
    }
    catch (\Illuminate\Database\QueryException $e) {
        return $this->sendError('Cannot delete record because it has related records in another table.');
    }
        return $this->sendSuccess('Testimonial deleted successfully');
    }
}
