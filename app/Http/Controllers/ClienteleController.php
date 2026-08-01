<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClienteleRequest;
use App\Http\Requests\UpdateClienteleRequest;
use App\Http\Controllers\AppBaseController;
use App\Models\ClienteleCategory;
use App\Repositories\ClienteleRepository;
use Illuminate\Http\Request;
use App\Exceptions\HandleForeignKeyConstraintViolation;
use Flash;

class ClienteleController extends AppBaseController
{
    /** @var ClienteleRepository $clienteleRepository*/
    private $clienteleRepository;

    public function __construct(ClienteleRepository $clienteleRepo)
    {
        $this->clienteleRepository = $clienteleRepo;

        $this->middleware('role_or_permission:add-clienteles', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-clienteles', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-clienteles', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-clienteles', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Clientele.
     */
    public function index(Request $request)
    {
        if(empty($request->type)){
            return redirect()->back();
        }
        return view('clienteles.index');
    }

    /**
     * Show the form for creating a new Clientele.
     */
    public function create(Request $request)
    {
        if(empty($request->type)){
            return redirect()->back();
        }
        $clienteleCategory = ClienteleCategory::where('type', $request->type)->first();
        return view('clienteles.create', compact('clienteleCategory'));
    }

    /**
     * Store a newly created Clientele in storage.
     */
    public function store(CreateClienteleRequest $request)
    {
        $input = $request->all();


        $clientele = $this->clienteleRepository->create($input);
        if ($request->hasfile('image')) {
            $clientele->image = uploadImage($request->file('image'), CLIENTELE_IMAGE_PATH);
        }
        $clientele->save();

        Flash::success('Clientele saved successfully.');

        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['image' => $clientele->image])
            ->log('Clientele - New Clientele created.');

        return redirect(route('clienteles.index') . '?type=' . $request->type);
    }

    /**
     * Display the specified Clientele.
     */
    public function show($id, Request $request)
    {
        if(empty($request->type)){
            return redirect()->back();
        }
        $clientele = $this->clienteleRepository->find($id);

        if (empty($clientele)) {
            Flash::error('Clientele not found');

            return redirect(route('clienteles.index'));
        }

        return view('clienteles.show')->with('clientele', $clientele);
    }

    /**
     * Show the form for editing the specified Clientele.
     */
    public function edit($id, Request $request)
    {
        if(empty($request->type)){
            return redirect()->back();
        }
        $clientele = $this->clienteleRepository->find($id);

        if (empty($clientele)) {
            Flash::error('Clientele not found');

            return redirect(route('clienteles.index'));
        }

        $clienteleCategory = ClienteleCategory::find($clientele->clientele_category_id);
        return view('clienteles.edit', compact('clienteleCategory', 'clientele'));
    }

    /**
     * Update the specified Clientele in storage.
     */
    public function update($id, UpdateClienteleRequest $request)
    {

        $clientele = $this->clienteleRepository->find($id);

        if (empty($clientele)) {
            Flash::error('Clientele not found');

            return redirect(route('clienteles.index'));
        }

        if ($request->hasfile('image')) {
            removeImage($clientele->image, CLIENTELE_IMAGE_PATH);
        }

        $clientele = $this->clienteleRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $clientele->image = uploadImage($request->file('image'), CLIENTELE_IMAGE_PATH);
        }
        $clientele->save();

        Flash::success('Clientele updated successfully.');

        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['image' => $clientele->image])
            ->log('Clientele -  Clientele name updated.');

        return redirect(route('clienteles.index') . '?type=' . $request->type);
    }

    /**
     * Remove the specified Clientele from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $clientele = $this->clienteleRepository->find($id);

        if (empty($clientele)) {
            Flash::error('Clientele not found');

            return redirect(route('clienteles.index'));
        }

        if ($clientele->image  != '') {
            removeImage($clientele->image, CLIENTELE_IMAGE_PATH);
        }

        try {
            $this->clienteleRepository->delete($id);

            Flash::success('Clientele deleted successfully.');

            activity()
                ->performedOn(getLoggedInUser())
                ->withProperties(['image' => $clientele->image])
                ->log('Clientele - Clientele removed.');

            return redirect(route('clienteles.index'));
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'clienteles.index');
        }
    }
}