<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Flash;

class PermissionController extends AppBaseController
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role_or_permission:add-permissions', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-permissions', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-permissions', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-permissions', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Permission.
     */
    public function index()
    {
        return view('user-management.permissions.index');
    }

    /**
     * Show the form for creating a new Permission.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('user-management.permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     */
    public function store(Request $request)
    {
        $check = Permission::where('name', $request->name)->first();
        if ($check == NULL) {
            Permission::create(['name' => $request->name, 'type' => 1]);
            Permission::create(['name' => 'add-' . $request->name]);
            Permission::create(['name' => 'edit-' . $request->name]);
            Permission::create(['name' => 'delete-' . $request->name]);
            Permission::create(['name' => 'view-' . $request->name]);
            Permission::create(['name' => 'publish-' . $request->name]);

            // Log Activity
            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['name' => $request->name])
                ->log('User Management / Permissions - New permission created.');

            Flash::success('Permission saved successfully.');

            $previousUrl = session()->get('previous_url');
            session()->forget('previous_url', route('permissions.index'));
            return redirect($previousUrl);
        } else {
            Flash::error('Permission already exists.');
            return redirect(route('permissions.create'));
        }
    }

    /**
     * Display the specified Permission.
     */
    public function show(Permission $permission)
    {
        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect()->back();
        }

        return view('user-management.permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified Permission.
     */
    public function edit(Permission $permission)
    {
        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('user-management.permissions.edit')->with('permission', $permission);
    }

    /**
     * Update the specified Permission in storage.
     */
    public function update(Permission $permission, Request $request)
    {
        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect()->back();
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
            ->performedOn(getLoggedInUser())
            ->withProperties(['name' => $request->name])
            ->log('User Management / Permissions - Permission details updated.');

        Flash::success('Permission updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('permissions.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $permission = Permission::find($id);
        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect()->back();
        }

        $permissionAdd = Permission::where('name', '=', 'add-' . $permission->name)->first();
        $permissionEdit = Permission::where('name', '=', 'edit-' . $permission->name)->first();
        $permissionDelete = Permission::where('name', '=', 'delete-' . $permission->name)->first();
        $permissionView = Permission::where('name', '=', 'view-' . $permission->name)->first();
        $permissionPublish = Permission::where('name', '=', 'publish-' . $permission->name)->first();

        if ($permissionAdd->roles->count() > 0 || $permissionEdit->roles->count() > 0 || $permissionDelete->roles->count() > 0 || $permissionView->roles->count() > 0 || $permissionPublish->roles->count() > 0) {
            Flash::error('Unable to delete becuase some roles assigned to this permission.');
        } else {
            $permissionAdd->delete();
            $permissionEdit->delete();
            $permissionDelete->delete();
            $permissionView->delete();
            $permissionPublish->delete();
            $permission->delete();

            // Log Activity
            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['name' => $permission->name])
                ->log('User Management / Permissions - Permission details removed.');

            Flash::success('Permission deleted successfully.');
        }

        return redirect()->back();
    }
}
