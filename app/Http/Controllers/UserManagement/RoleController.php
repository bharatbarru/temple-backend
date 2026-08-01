<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Flash;

class RoleController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role_or_permission:add-roles', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-roles', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-roles', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-roles', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     */
    public function index()
    {
        return view('user-management.roles.index');
    }

    /**
     * Show the form for creating a new User.
     */
    public function create()
    {
        $permissions = Permission::where('type', 1)->get();

        session()->put('previous_url', url()->previous());
        return view('user-management.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     */
    public function store(Request $request)
    {
        $check = Role::where('name', $request->name)->first();
        if ($check == NULL) {
            $role = Role::create(['name' => $request->name]);

            $permissions = Permission::where('type', 1)->get();
            foreach ($permissions as $permission) {
                if ($request->has('add-' . $permission->name)) {
                    $role->givePermissionTo('add-' . $permission->name);
                }
                if ($request->has('edit-' . $permission->name)) {
                    $role->givePermissionTo('edit-' . $permission->name);
                }
                if ($request->has('delete-' . $permission->name)) {
                    $role->givePermissionTo('delete-' . $permission->name);
                }
                if ($request->has('view-' . $permission->name)) {
                    $role->givePermissionTo('view-' . $permission->name);
                }
                if ($request->has('publish-' . $permission->name)) {
                    $role->givePermissionTo('publish-' . $permission->name);
                }
            }

            // Log Activity
            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['name' => $request->name])
                ->log('User Management / Roles - New role created.');

            Flash::success('Role saved successfully.');

            $previousUrl = session()->get('previous_url');
            session()->forget('previous_url', route('roles.index'));
            return redirect($previousUrl);
        } else {
            Flash::error('Role already exists.');
            return redirect(route('roles.create'));
        }
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     */
    public function show(Role $role)
    {
        if (empty($role)) {
            Flash::error('Role not found');

            return redirect()->back();
        }

        return view('user-management.roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     */
    public function edit(Role $role)
    {
        $permissions = Permission::where('type', 1)->get();
        if (empty($role)) {
            Flash::error('Role not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('user-management.roles.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     */
    public function update(Role $role, Request $request)
    {
        if (empty($role)) {
            Flash::error('Role not found');

            return redirect()->back();
        }
        $role->update(['name' => $request->name]);

        $permissions = Permission::where('type', 1)->get();
        foreach ($permissions as $permission) {
            $request->has('add-' . $permission->name) ? $role->givePermissionTo('add-' . $permission->name) : $role->revokePermissionTo('add-' . $permission->name);
            $request->has('edit-' . $permission->name) ? $role->givePermissionTo('edit-' . $permission->name) : $role->revokePermissionTo('edit-' . $permission->name);
            $request->has('delete-' . $permission->name) ? $role->givePermissionTo('delete-' . $permission->name) : $role->revokePermissionTo('delete-' . $permission->name);
            $request->has('view-' . $permission->name) ? $role->givePermissionTo('view-' . $permission->name) : $role->revokePermissionTo('view-' . $permission->name);
            $request->has('publish-' . $permission->name) ? $role->givePermissionTo('publish-' . $permission->name) : $role->revokePermissionTo('publish-' . $permission->name);
        }

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['name' => $request->name])
            ->log('User Management / Roles - Role details update.');

        Flash::success('Role updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('roles.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        if (empty($role)) {
            Flash::error('Role not found');

            return redirect()->back();
        }

        if ($role->users->count() > 0) {
            Flash::error('Unable to delete becuase some users assigned to this role.');
        } else {
            $role->delete();

            // Log Activity
            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['name' => $role->name])
                ->log('User Management / Roles - Role details removed.');

            Flash::success('Role deleted successfully.');
        }

        return redirect()->back();
    }
}
