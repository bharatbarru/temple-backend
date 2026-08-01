<?php

namespace App\Http\Controllers\API\UserManagement;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\AppBaseController;

/**
 * Class RoleAPIController
 */
class RoleAPIController extends AppBaseController
{
    /**
     * @OA\Get(
     *      path="/roles",
     *      summary="Get list of roles",
     *      tags={"User Management / Roles"},
     *      description="Get all roles using Spatie Laravel Roles",
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
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(
     *                          property="id",
     *                          type="integer",
     *                          example=1
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string",
     *                          example="admin"
     *                      ),
     *                      @OA\Property(
     *                          property="guard_name",
     *                          type="string",
     *                          example="web"
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
        $roles = Role::all();

        return $this->sendResponse($roles->toArray(), 'Roles retrieved successfully');
    }

    /**
     * @OA\Post(
     *      path="/roles",
     *      summary="Create a new role",
     *      tags={"User Management / Roles"},
     *      description="Create a new role using Spatie Laravel Roles",
     *      @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *            type="object",
     *            @OA\Property(
     *                property="name",
     *                type="string",
     *                example="admin"
     *            ),
     *            @OA\Property(
     *                property="permissions",
     *                type="array",
     *                @OA\Items(
     *                    type="string",
     *                    example="edit articles"
     *                )
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
     *                      ),
     *                      @OA\Property(
     *                          property="permissions",
     *                          type="array",
     *                          @OA\Items(
     *                              type="string"
     *                          )
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
        $check = Role::where('name', $request->name)->first();
        if ($check == NULL) {
            $role = Role::create(['name' => $request->name]);

            $permissions = Permission::where('type', 1)->get();
            // $list = explode(", ", $request->permissions);
            $list = $request->permissions;
            foreach ($permissions as $permission) {
                if (in_array('add-' . $permission->name, $list)) {
                    $role->givePermissionTo('add-' . $permission->name);
                }
                if (in_array('edit-' . $permission->name, $list)) {
                    $role->givePermissionTo('edit-' . $permission->name);
                }
                if (in_array('delete-' . $permission->name, $list)) {
                    $role->givePermissionTo('delete-' . $permission->name);
                }
                if (in_array('view-' . $permission->name, $list)) {
                    $role->givePermissionTo('view-' . $permission->name);
                }
                if (in_array('publish-' . $permission->name, $list)) {
                    $role->givePermissionTo('publish-' . $permission->name);
                }
            }
        } else {
            return $this->sendError('Role already exists.');
        }

        // Log Activity
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['name' => $request->name])
            ->log('API / User Management / Roles - New role created.');

        return $this->sendResponse([$role->toArray()], 'Role saved successfully');
    }

    /**
     * @OA\Get(
     *      path="/roles/{id}",
     *      summary="Get role by ID",
     *      tags={"User Management / Roles"},
     *      description="Get a role by its ID using Spatie",
     *      @OA\Parameter(
     *          name="id",
     *          description="ID of the role",
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
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            return $this->sendError('Role not found');
        }

        return $this->sendResponse($role->toArray(), 'Role retrieved successfully');
    }

    /**
     * @OA\Put(
     *      path="/roles/{id}",
     *      summary="updateRole",
     *      tags={"User Management / Roles"},
     *      description="Update a role",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="ID of the role",
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
     *            ),
     *            @OA\Property(
     *                property="permissions",
     *                type="array",
     *                @OA\Items(
     *                    type="integer",
     *                )
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
     *                          property="permissions",
     *                          type="array",
     *                          @OA\Items(
     *                              type="object",
     *                              @OA\Property(
     *                                  property="name",
     *                                  type="string"
     *                              ),
     *                              @OA\Property(
     *                                  property="guard_name",
     *                                  type="string"
     *                              )
     *                          )
     *                      )
     *                  )
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Role updated successfully"
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
     *          description="Role not found",
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
     *                  example="Role not found"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, Request $request): JsonResponse
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            return $this->sendError('Role not found');
        }

        $role->update(['name' => $request->name]);

        $permissions = Permission::where('type', 1)->get();
        // $list = explode(", ", $request->permissions);
        $list = $request->permissions;
        foreach ($permissions as $permission) {
            in_array('add-' . $permission->name, $list) ? $role->givePermissionTo('add-' . $permission->name) : $role->revokePermissionTo('add-' . $permission->name);
            in_array('edit-' . $permission->name, $list) ? $role->givePermissionTo('edit-' . $permission->name) : $role->revokePermissionTo('edit-' . $permission->name);
            in_array('delete-' . $permission->name, $list) ? $role->givePermissionTo('delete-' . $permission->name) : $role->revokePermissionTo('delete-' . $permission->name);
            in_array('view-' . $permission->name, $list) ? $role->givePermissionTo('view-' . $permission->name) : $role->revokePermissionTo('view-' . $permission->name);
            in_array('publish-' . $permission->name, $list) ? $role->givePermissionTo('publish-' . $permission->name) : $role->revokePermissionTo('publish-' . $permission->name);
        }

        // Log Activity
        activity()
            ->performedOn(getAPIUser())
            ->withProperties(['name' => $request->name])
            ->log('API / User Management / Roles - Role details update.');

        return $this->sendResponse($role->toArray(), 'Role updated successfully');
    }

    /**
     * @OA\Delete(
     *      path="/roles/{id}",
     *      summary="deleteRole",
     *      tags={"User Management / Roles"},
     *      description="Delete a role",
     *      security={{"bearerAuth": {}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="ID of the role",
     *          in="path",
     *          required=true,
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="No content"
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
     *          description="Role not found",
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
     *                  example="Role not found"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id): JsonResponse
    {
        /** @var Role $role */
        $role = Role::find($id);

        if (empty($role)) {
            return $this->sendError('Role not found');
        }

        if ($role->users->count() > 0) {
            return $this->sendError('Unable to delete becuase some users assigned to this role');
        } else {
            $role->delete();

            // Log Activity
            activity()
                ->performedOn(getAPIUser())
                ->withProperties(['name' => $role->name])
                ->log('API / User Management / Roles - Role details removed.');
        }

        return $this->sendSuccess('Role deleted successfully');
    }
}
