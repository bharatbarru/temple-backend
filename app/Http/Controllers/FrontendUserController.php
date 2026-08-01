<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateFrontendUserRequest;
use App\Http\Requests\UpdateFrontendUserRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\FrontendUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Flash;

class FrontendUserController extends AppBaseController
{
    /** @var FrontendUserRepository $frontendUserRepository*/
    private $frontendUserRepository;

    public function __construct(FrontendUserRepository $frontendUserRepo)
    {
        $this->frontendUserRepository = $frontendUserRepo;
        $this->middleware('role_or_permission:add-frontend-users', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-frontend-users', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-frontend-users', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-frontend-users', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the FrontendUser.
     */
    public function index(Request $request)
    {
        return view('frontend_users.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $frontendUser)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'First Name' => $frontendUser->first_name,
                'Last Name' => $frontendUser->last_name,
                'Email' => $frontendUser->email,
                'Mobile' => $frontendUser->mobile,
                'Address' => $frontendUser->address,
                'Country' => $frontendUser->country,
                'State' => $frontendUser->state,
                'City' => $frontendUser->city,
                'Pincode' => $frontendUser->pincode
            ])
            ->log('Frontend Users - ' . $description);
    }

    /**
     * Show the form for creating a new FrontendUser.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('frontend_users.create');
    }

    /**
     * Store a newly created FrontendUser in storage.
     */
    public function store(CreateFrontendUserRequest $request)
    {
        $input = $request->all();

        $randomPassword = Str::random(8);
        $input['password'] = bcrypt($randomPassword);
        $frontendUser = $this->frontendUserRepository->create($input);

        // Log Activity
        $this->activityLog('New User Created.', $frontendUser);

        Flash::success('Frontend User saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('frontendUsers.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified FrontendUser.
     */
    public function show($id)
    {
        $frontendUser = $this->frontendUserRepository->find($id);

        if (empty($frontendUser)) {
            Flash::error('Frontend User not found');

            return redirect()->back();
        }

        return view('frontend_users.show')->with('frontendUser', $frontendUser);
    }

    /**
     * Show the form for editing the specified FrontendUser.
     */
    public function edit($id)
    {
        $frontendUser = $this->frontendUserRepository->find($id);

        if (empty($frontendUser)) {
            Flash::error('Frontend User not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('frontend_users.edit')->with('frontendUser', $frontendUser);
    }

    /**
     * Update the specified FrontendUser in storage.
     */
    public function update($id, UpdateFrontendUserRequest $request)
    {
        $frontendUser = $this->frontendUserRepository->find($id);

        if (empty($frontendUser)) {
            Flash::error('Frontend User not found');

            return redirect()->back();
        }

        $frontendUser = $this->frontendUserRepository->update($request->all(), $id);

        // Log Activity
        $this->activityLog('User details updated.', $frontendUser);

        Flash::success('Frontend User updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('frontendUsers.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified FrontendUser from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $frontendUser = $this->frontendUserRepository->find($id);

        if (empty($frontendUser)) {
            Flash::error('Frontend User not found');

            return redirect()->back();
        }

        try {
            $this->frontendUserRepository->delete($id);

            // Log Activity
            $this->activityLog('User details removed.', $frontendUser);

            Flash::success('Frontend User deleted successfully.');

            return redirect()->back();
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'frontendUsers.index');
        }
    }
}
