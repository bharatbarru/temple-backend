<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTeamCategoryAPIRequest;
use App\Http\Requests\API\UpdateTeamCategoryAPIRequest;
use App\Models\TeamCategory;
use App\Repositories\TeamCategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TeamCategoryResource;

/**
 * Class TeamCategoryController
 */

class TeamCategoryAPIController extends AppBaseController
{
    /** @var  TeamCategoryRepository */
    private $teamCategoryRepository;

    public function __construct(TeamCategoryRepository $teamCategoryRepo)
    {
        $this->teamCategoryRepository = $teamCategoryRepo;
    }

    /**
     * @OA\Get(
     *      path="/team-categories",
     *      summary="getTeamCategoryList",
     *      tags={"TeamCategory"},
     *      description="Get all TeamCategories",
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
     *                  @OA\Items(ref="#/components/schemas/TeamCategory")
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
        $teamCategories = TeamCategory::orderBy('sort')->get();

        foreach ($teamCategories as $teamCategory) {
            if (!empty($teamCategory->image)) {
                $teamCategory->image = url(TEAM_CATEGORY_IMAGE_PATH . $teamCategory->image);
            }
            $teamCategory->makeHidden(['created_at', 'updated_at', 'sort']);

            foreach ($teamCategory->team as $team) {
                if (!empty($team->image)) {
                    $team->image = url(TEAM_IMAGE_PATH . $team->image);
                }
                $team->makeHidden(['id', 'team_categories_id' ,'created_at', 'updated_at', 'sort']);
            }
        }

        return $this->sendResponse($teamCategories->toArray(), 'Team Categories retrieved successfully');
    }


    /**
     * @OA\Post(
     *      path="/team-categories",
     *      summary="createTeamCategory",
     *      tags={"TeamCategory"},
     *      description="Create TeamCategory",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/TeamCategory")
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
     *                  ref="#/components/schemas/TeamCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTeamCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $teamCategory = $this->teamCategoryRepository->create($input);

        return $this->sendResponse(new TeamCategoryResource($teamCategory), 'Team Category saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/team-categories/{id}",
     *      summary="getTeamCategoryItem",
     *      tags={"TeamCategory"},
     *      description="Get TeamCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TeamCategory",
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
     *                  ref="#/components/schemas/TeamCategory"
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
        /** @var TeamCategory $teamCategory */
        $teamCategory = $this->teamCategoryRepository->find($id);

        if (empty($teamCategory)) {
            return $this->sendError('Team Category not found');
        }

        return $this->sendResponse(new TeamCategoryResource($teamCategory), 'Team Category retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/team-categories/{id}",
     *      summary="updateTeamCategory",
     *      tags={"TeamCategory"},
     *      description="Update TeamCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TeamCategory",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/TeamCategory")
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
     *                  ref="#/components/schemas/TeamCategory"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTeamCategoryAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var TeamCategory $teamCategory */
        $teamCategory = $this->teamCategoryRepository->find($id);

        if (empty($teamCategory)) {
            return $this->sendError('Team Category not found');
        }

        $teamCategory = $this->teamCategoryRepository->update($input, $id);

        return $this->sendResponse(new TeamCategoryResource($teamCategory), 'TeamCategory updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/team-categories/{id}",
     *      summary="deleteTeamCategory",
     *      tags={"TeamCategory"},
     *      description="Delete TeamCategory",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of TeamCategory",
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
        /** @var TeamCategory $teamCategory */
        $teamCategory = $this->teamCategoryRepository->find($id);

        if (empty($teamCategory)) {
            return $this->sendError('Team Category not found');
        }

        $teamCategory->delete();

        return $this->sendSuccess('Team Category deleted successfully');
    }
}
