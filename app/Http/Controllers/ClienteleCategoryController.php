<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateClienteleCategoryRequest;
use App\Http\Requests\UpdateClienteleCategoryRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ClienteleCategoryRepository;
use Illuminate\Http\Request;
use App\Exceptions\HandleForeignKeyConstraintViolation;
use Flash;

class ClienteleCategoryController extends AppBaseController
{
    /** @var ClienteleCategoryRepository $clienteleCategoryRepository*/
    private $clienteleCategoryRepository;

    public function __construct(ClienteleCategoryRepository $clienteleCategoryRepo)
    {
        $this->clienteleCategoryRepository = $clienteleCategoryRepo;

        $this->middleware('role_or_permission:add-clientele_categories', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-clientele_categories', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-clientele_categories', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-clientele_categories', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the ClienteleCategory.
     */
    public function index(Request $request)
    {
        return view('clientele_categories.index');
    }

    /**
     * Show the form for creating a new ClienteleCategory.
     */
    public function create()
    {
        return view('clientele_categories.create');
    }

    /**
     * Store a newly created ClienteleCategory in storage.
     */
    public function store(CreateClienteleCategoryRequest $request)
    {
        $input = $request->all();

        $clienteleCategory = $this->clienteleCategoryRepository->create($input);

        $htmlMenuCode = '<li class="nav-item">
                        <a href="{{ url(\'admin/clienteles?type=' . $clienteleCategory->type . '\') }}"
                            class="nav-link {{ request()->input("type") == "'. $clienteleCategory->type .'"
                                ? "active" : "" }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>' . $clienteleCategory->name . '</p>
                        </a>
                    </li>';
        $filePath = resource_path('views/layouts/menu.blade.php');
        file_put_contents($filePath, $htmlMenuCode, FILE_APPEND);

        Flash::success('Clientele Category saved successfully.');

        return redirect(route('clienteleCategories.index'));
    }

    /**
     * Display the specified ClienteleCategory.
     */
    public function show($id)
    {
        $clienteleCategory = $this->clienteleCategoryRepository->find($id);

        if (empty($clienteleCategory)) {
            Flash::error('Clientele Category not found');

            return redirect(route('clienteleCategories.index'));
        }

        return view('clientele_categories.show')->with('clienteleCategory', $clienteleCategory);
    }

    /**
     * Show the form for editing the specified ClienteleCategory.
     */
    public function edit($id)
    {
        $clienteleCategory = $this->clienteleCategoryRepository->find($id);

        if (empty($clienteleCategory)) {
            Flash::error('Clientele Category not found');

            return redirect(route('clienteleCategories.index'));
        }

        return view('clientele_categories.edit')->with('clienteleCategory', $clienteleCategory);
    }

    /**
     * Update the specified ClienteleCategory in storage.
     */
    public function update($id, UpdateClienteleCategoryRequest $request)
    {
        $clienteleCategory = $this->clienteleCategoryRepository->find($id);

        if (empty($clienteleCategory)) {
            Flash::error('Clientele Category not found');

            return redirect(route('clienteleCategories.index'));
        }

        $clienteleCategory = $this->clienteleCategoryRepository->update($request->all(), $id);

        Flash::success('Clientele Category updated successfully.');

        return redirect(route('clienteleCategories.index'));
    }

    /**
     * Remove the specified ClienteleCategory from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $clienteleCategory = $this->clienteleCategoryRepository->find($id);

        if (empty($clienteleCategory)) {
            Flash::error('Clientele Category not found');

            return redirect(route('clienteleCategories.index'));
        }
        try {
            $this->clienteleCategoryRepository->delete($id);

            Flash::success('Clientele Category deleted successfully.');

            return redirect(route('clienteleCategories.index'));
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'clienteleCategories.index');
        }
    }
}
