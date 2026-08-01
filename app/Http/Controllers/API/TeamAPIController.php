<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTeamAPIRequest;
use App\Http\Requests\API\UpdateTeamAPIRequest;
use App\Models\Team;
use App\Repositories\TeamRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\TeamResource;

/**
 * Class TeamController
 */

class TeamAPIController extends AppBaseController
{
    /** @var  TeamRepository */
    private $teamRepository;

    public function __construct(TeamRepository $teamRepo)
    {
        $this->teamRepository = $teamRepo;
    }

    /**
     * @OA\Get(
     *      path="/teams",
     *      summary="getTeamList",
     *      tags={"Team"},
     *      description="Get all Teams",
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
     *                  @OA\Items(ref="#/components/schemas/Team")
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
        $teams = $this->teamRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse(TeamResource::collection($teams), 'Teams retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/teams",
     *      summary="createTeam",
     *      tags={"Team"},
     *      description="Create Team",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Team")
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
     *                  ref="#/components/schemas/Team"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTeamAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $team = $this->teamRepository->create($input);

        return $this->sendResponse(new TeamResource($team), 'Team saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/teams/{id}",
     *      summary="getTeamItem",
     *      tags={"Team"},
     *      description="Get Team",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Team",
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
     *                  ref="#/components/schemas/Team"
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
        /** @var Team $team */
        $teams = Team::where('team_categories_id', $id)->orderBy('sort')->get();

        if (empty($teams)) {
            return $this->sendError('Team not found');
        }

        foreach ($teams as $team) {
            if (!empty($team->image)) {
                $team->image = url(TEAM_IMAGE_PATH . $team->image);
                $team->makeHidden(['id', 'team_categories_id' ,'created_at', 'updated_at', 'sort']);
            }
        }

        return $this->sendResponse($teams->toArray(), 'Team retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/teams/{id}",
     *      summary="updateTeam",
     *      tags={"Team"},
     *      description="Update Team",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Team",
     *           @OA\Schema(
     *             type="integer"
     *          ),
     *          required=true,
     *          in="path"
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/Team")
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
     *                  ref="#/components/schemas/Team"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTeamAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Team $team */
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            return $this->sendError('Team not found');
        }

        $team = $this->teamRepository->update($input, $id);

        return $this->sendResponse(new TeamResource($team), 'Team updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/teams/{id}",
     *      summary="deleteTeam",
     *      tags={"Team"},
     *      description="Delete Team",
     *      @OA\Parameter(
     *          name="id",
     *          description="id of Team",
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
        /** @var Team $team */
        $team = $this->teamRepository->find($id);

        if (empty($team)) {
            return $this->sendError('Team not found');
        }

        $team->delete();

        return $this->sendSuccess('Team deleted successfully');
    }
}
