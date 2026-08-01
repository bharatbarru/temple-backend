<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFaqAPIRequest;
use App\Http\Requests\API\UpdateFaqAPIRequest;
use App\Models\Faq;
use App\Repositories\FaqRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\FaqResource;

/**
 * Class FaqController
 */

class FaqAPIController extends AppBaseController
{
    /** @var  FaqRepository */
    private $faqRepository;

    public function __construct(FaqRepository $faqRepo)
    {
        $this->faqRepository = $faqRepo;
    }

    /**
     * @OA\Get(
     *      path="/faqs",
     *      summary="getFaqList",
     *      tags={"Faq"},
     *      description="Get all Faqs",
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
     *                  @OA\Items(ref="#/components/schemas/Faq")
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
        $faqs = $this->faqRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(FaqResource::collection($faqs), 'Faqs retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/faqs",
     *      summary="createFaq",
     *      tags={"Faq"},
     *      description="Create Faq",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Faq")
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
     *                  ref="#/components/schemas/Faq"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateFaqAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $faq = $this->faqRepository->create($input);

        return $this->sendResponse(new FaqResource($faq), 'Faq saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/faqs/{id}",
     *      summary="getFaqItem",
     *      tags={"Faq"},
     *      description="Get Faq",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Faq",
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
     *                  ref="#/components/schemas/Faq"
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
        /** @var Faq $faq */
        $faq = $this->faqRepository->find($id);

        if (empty($faq)) {
            return $this->sendError('Faq not found');
        }

        return $this->sendResponse(new FaqResource($faq), 'Faq retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/faqs/{id}",
     *      summary="updateFaq",
     *      tags={"Faq"},
     *      description="Update Faq",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Faq",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Faq")
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
     *                  ref="#/components/schemas/Faq"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateFaqAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Faq $faq */
        $faq = $this->faqRepository->find($id);

        if (empty($faq)) {
            return $this->sendError('Faq not found');
        }

        $faq = $this->faqRepository->update($input, $id);

        return $this->sendResponse(new FaqResource($faq), 'Faq updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/faqs/{id}",
     *      summary="deleteFaq",
     *      tags={"Faq"},
     *      description="Delete Faq",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Faq",
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
        /** @var Faq $faq */
        $faq = $this->faqRepository->find($id);

        if (empty($faq)) {
            return $this->sendError('Faq not found');
        }

        $faq->delete();

        return $this->sendSuccess('Faq deleted successfully');
    }
}
