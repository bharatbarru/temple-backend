<?php

namespace App\Http\Controllers\UserManagement;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use Flash;
use Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends AppBaseController
{
    /** @var $userRepository UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('role_or_permission:add-users', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-users', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-users', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-users', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     */
    public function index()
    {
        return view('user-management.users.index');
    }

    /**
     * Show the form for creating a new User.
     */
    public function create()
    {
        if (auth()->user()->roles->first() != null && auth()->user()->roles->first()->name == DEVELOPER_ROLE) {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', DEVELOPER_ROLE)->get();
        }

        session()->put('previous_url', url()->previous());
        return view('user-management.users.create', compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = $this->userRepository->create($input);

        if ($request->role != '') {
            $user->assignRole($request->role);
        }

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['name' => $user->name, 'email' => $user->email])
            ->log('User Management / Users - New user created.');

        Flash::success('User saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('users.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect()->back();
        }

        return view('user-management.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     */
    public function edit($id)
    {
        if (auth()->user()->roles->first() != null && auth()->user()->roles->first()->name == DEVELOPER_ROLE) {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', DEVELOPER_ROLE)->get();
        }
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('user-management.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect()->back();
        }
        $input =  $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
        $user = $this->userRepository->update($input, $id);
        $user->syncRoles($request->role);

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['name' => $user->name, 'email' => $user->email])
            ->log('User Management / Users - User details updated.');

        Flash::success('User updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('users.index'));
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
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect()->back();
        }

        if ($user->id == Auth::user()->id) {
            Flash::error('You can not delete your own account.');

            return redirect()->back();
        }


        try {
            $user->delete();

            // Log Activity
            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['name' => $user->name, 'email' => $user->email])
                ->log('User Management / Users - User details removed.');

            Flash::success('User deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'users.index');
        }
    }

    public function reset($id)
    {
        return view('user-management.users.reset')->with('id', $id);
    }

    public function resetPassword(Request $request)
    {
        $user = User::find($request->id);

        $user->password = Hash::make($request->password);
        $user->save();

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['name' => $user->name, 'email' => $user->email])
            ->log('User Management / Users - User password changed.');

        Flash::success('Password Updated Successfully.');
        return redirect()->back();
    }
}
