<?php

namespace App\Http\Controllers;

use App\Exceptions\HandleForeignKeyConstraintViolation;
use App\Http\Requests\CreatePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\PaymentMethodRepository;
use Illuminate\Http\Request;
use Flash;

class PaymentMethodController extends AppBaseController
{
    /** @var PaymentMethodRepository $paymentMethodRepository*/
    private $paymentMethodRepository;

    public function __construct(PaymentMethodRepository $paymentMethodRepo)
    {
        $this->paymentMethodRepository = $paymentMethodRepo;
        $this->middleware('role_or_permission:add-payment-methods', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-payment-methods', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-payment-methods', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-payment-methods', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the PaymentMethod.
     */
    public function index(Request $request)
    {
        return view('payment_methods.index');
    }

    /**
     * Activity Log
     */
    public function activityLog($description, $paymentMethod)
    {
        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties([
                'Payment Method name' => $paymentMethod->payment_method_name,
                'Display Name' => $paymentMethod->display_name
            ])
            ->log('Payment Methods - ' . $description);
    }

    /**
     * Show the form for creating a new PaymentMethod.
     */
    public function create()
    {
        return view('payment_methods.create');
    }

    /**
     * Store a newly created PaymentMethod in storage.
     */
    public function store(CreatePaymentMethodRequest $request)
    {
        $input = $request->all();

        $paymentMethod = $this->paymentMethodRepository->create($input);

        // Log Activity
        $this->activityLog('New Payment Method Created.', $paymentMethod);

        Flash::success('Payment Method saved successfully.');

        return redirect(route('paymentMethods.index'));
    }

    /**
     * Display the specified PaymentMethod.
     */
    public function show($id)
    {
        $paymentMethod = $this->paymentMethodRepository->find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        return view('payment_methods.show')->with('paymentMethod', $paymentMethod);
    }

    /**
     * Show the form for editing the specified PaymentMethod.
     */
    public function edit($id)
    {
        $paymentMethod = $this->paymentMethodRepository->find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        return view('payment_methods.edit')->with('paymentMethod', $paymentMethod);
    }

    /**
     * Update the specified PaymentMethod in storage.
     */
    public function update($id, UpdatePaymentMethodRequest $request)
    {
        $paymentMethod = $this->paymentMethodRepository->find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        $paymentMethod = $this->paymentMethodRepository->update($request->all(), $id);

        // Log activity
        $this->activityLog('Payment method details updated.', $paymentMethod);

        Flash::success('Payment Method updated successfully.');

        return redirect(route('paymentMethods.index'));
    }

    /**
     * Remove the specified PaymentMethod from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $paymentMethod = $this->paymentMethodRepository->find($id);

        if (empty($paymentMethod)) {
            Flash::error('Payment Method not found');

            return redirect(route('paymentMethods.index'));
        }

        try {
            $this->paymentMethodRepository->delete($id);

            Flash::success('Payment Method deleted successfully.');

            // Log Activity
            $this->activityLog('Payment method details removed.', $paymentMethod);

            return redirect(route('paymentMethods.index'));
        } catch (\Illuminate\Database\QueryException $e) {
            return HandleForeignKeyConstraintViolation::handle($e, 'paymentMethods.index');
        }
    }
}
