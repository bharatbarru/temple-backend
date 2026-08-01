<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;
use Flash;

class CustomerController extends AppBaseController
{
    /** @var CustomerRepository $customerRepository*/
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepo)
    {
        $this->customerRepository = $customerRepo;
        $this->middleware('role_or_permission:add-customers', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-customers', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-customers', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-customers', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Customer.
     */
    public function index(Request $request)
    {
        return view('customers.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $customer)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Name' => $customer->name,
                'Email' => $customer->email,
                'Mobile' => $customer->mobile
            ])
            ->log('Customers - ' . $description);
    }

    /**
     * Show the form for creating a new Customer.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created Customer in storage.
     */
    public function store(CreateCustomerRequest $request)
    {
        $input = $request->all();

        $customer = $this->customerRepository->create($input);

        // Log Activity
        $this->activityLog('New Customer Created.', $customer);

        Flash::success('Customer saved successfully.');

        return redirect(route('customers.index'));
    }

    /**
     * Display the specified Customer.
     */
    public function show($id)
    {
        $customer = $this->customerRepository->find($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('customers.show')->with('customer', $customer);
    }

    /**
     * Show the form for editing the specified Customer.
     */
    public function edit($id)
    {
        $customer = $this->customerRepository->find($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        return view('customers.edit')->with('customer', $customer);
    }

    /**
     * Update the specified Customer in storage.
     */
    public function update($id, UpdateCustomerRequest $request)
    {
        $customer = $this->customerRepository->find($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        $customer = $this->customerRepository->update($request->all(), $id);

        // Log Activity
        $this->activityLog('Customer details updated.', $customer);

        Flash::success('Customer updated successfully.');

        return redirect(route('customers.index'));
    }

    /**
     * Remove the specified Customer from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $customer = $this->customerRepository->find($id);

        if (empty($customer)) {
            Flash::error('Customer not found');

            return redirect(route('customers.index'));
        }

        try {
            $this->customerRepository->delete($id);

            // Log Activity
            $this->activityLog('Customer details removed.', $customer);

            Flash::success('Customer deleted successfully.');

            return redirect(route('customers.index'));
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'customers.index');
        }
    }
}
