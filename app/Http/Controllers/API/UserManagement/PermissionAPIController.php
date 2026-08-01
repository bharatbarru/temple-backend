<?php

namespace App\Http\Controllers\API\UserManagement;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\AppBaseController;

/**
 * Class PermissionAPIController
 */
class PermissionAPIController extends AppBaseController
{

    /**
     * @OA\Get(
     *      path="/permissions",
     *      summary="get permissions list",
     *      tags={"User Management / Permission"},
     *      description="Get all permissions using Spatie",
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
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="guard_name",
     *                          type="string"
     *                      )
     *                  )
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
        $permissions = Permission::where('type', 1)->get();

        return $this->sendResponse($permissions->toArray(), 'Permissions retrieved successfully');
    }


    /**
     * @OA\Post(
     *      path="/permissions",
     *      summary="create permissions",
     *      tags={"User Management / Permission"},
     *      description="Create new permissions using Spatie",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *            type="object",
     *            @OA\Property(
     *                property="name",
     *                type="string"
     *            )
     *        )
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
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      )
     *                  )
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $check = Permission::where('name', $request->name)->first();
        if ($check == NULL) {
            $permission = Permission::create(['name' => $request->name, 'type' => 1]);
            Permission::create(['name' => 'add-' . $request->name]);
            Permission::create(['name' => 'edit-' . $request->name]);
            Permission::create(['name' => 'delete-' . $request->name]);
            Permission::create(['name' => 'view-' . $request->name]);
            Permission::create(['name' => 'publish-' . $request->name]);

            // Log Activity
            activity()
                ->performedOn(getAPIUser())
                ->withProperties(['name' => $request->name])
                ->log('API / User Management / Permissions - New permission created.');
        } else {
            return $this->sendError('Permission already exists.');
        }

        return $this->sendResponse([$permission->toArray()], 'Permission saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/permissions/{id}",
     *      summary="get permission by ID",
     *      tags={"User Management / Permission"},
     *      description="Get a permission by its ID using Spatie",
     *      @OA\Parameter(
     *          name="id",
     *          description="ID of the permission",
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
     *                  type="object",
     *                  @OA\Property(
     *                      property="name",
     *                      type="string"
     *                  ),
     *                  @OA\Property(
     *                      property="guard_name",
     *                      type="string"
     *                  )
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
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        return $this->sendResponse($permission->toArray(), 'Permission retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/permissions/{id}",
     *      summary="updatePermission",
     *      tags={"User Management / Permission"},
     *      description="Update a permission",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="ID of the permission",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *            type="object",
     *            @OA\Property(
     *                property="name",
     *                type="string"
     *            )
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  example=true
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="guard_name",
     *                          type="string"
     *                      )
     *                  )
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Permission updated successfully"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  example=false
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Unauthorized"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Permission not found",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  example=false
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Permission not found"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Request $request): JsonResponse
    {
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        $permissionAdd = Permission::where('name', '=', 'add-' . $permission->name)->first();
        $permissionEdit = Permission::where('name', '=', 'edit-' . $permission->name)->first();
        $permissionDelete = Permission::where('name', '=', 'delete-' . $permission->name)->first();
        $permissionView = Permission::where('name', '=', 'view-' . $permission->name)->first();
        $permissionPublish = Permission::where('name', '=', 'publish-' . $permission->name)->first();

        $permissionAdd->update(['name' => 'add-' . $request->name]);
        $permissionEdit->update(['name' => 'edit-' . $request->name]);
        $permissionDelete->update(['name' => 'delete-' . $request->name]);
        $permissionView->update(['name' => 'view-' . $request->name]);
        $permissionPublish->update(['name' => 'publish-' . $request->name]);
        $permission->update(['name' => $request->name]);

        // Log Activity
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['name' => $request->name])
            ->log('API / User Management / Permissions - Permission details updated.');


        return $this->sendResponse($permission->toArray(), 'Permission updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/permissions/{id}",
     *      summary="deletePermission",
     *      tags={"User Management / Permission"},
     *      description="Delete a permission",
     *      @OA\Parameter(
     *          name="id",
     *          description="ID of the permission",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
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
        /** @var Permission $permission */
        $permission = Permission::find($id);

        if (empty($permission)) {
            return $this->sendError('Permission not found');
        }

        $permissionAdd = Permission::where('name', '=', 'add-' . $permission->name)->first();
        $permissionEdit = Permission::where('name', '=', 'edit-' . $permission->name)->first();
        $permissionDelete = Permission::where('name', '=', 'delete-' . $permission->name)->first();
        $permissionView = Permission::where('name', '=', 'view-' . $permission->name)->first();
        $permissionPublish = Permission::where('name', '=', 'publish-' . $permission->name)->first();

        if ($permissionAdd->roles->count() > 0 || $permissionEdit->roles->count() > 0 || $permissionDelete->roles->count() > 0 || $permissionView->roles->count() > 0 || $permissionPublish->roles->count() > 0) {
            return $this->sendError('Unable to delete becuase some roles assigned to this permission.');
        } else {
            $permissionAdd->delete();
            $permissionEdit->delete();
            $permissionDelete->delete();
            $permissionView->delete();
            $permissionPublish->delete();
            $permission->delete();
        }

        // Log Activity
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['name' => $permission->name])
            ->log('API / User Management / Permissions - Permission details removed.');

        return $this->sendSuccess('Permission deleted successfully');
    }
}
