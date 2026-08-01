<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SliderRepository;
use Illuminate\Http\Request;
use Flash;

class SliderController extends AppBaseController
{
    /** @var SliderRepository $sliderRepository*/
    private $sliderRepository;

    public function __construct(SliderRepository $sliderRepo)
    {
        $this->sliderRepository = $sliderRepo;
        $this->middleware('role_or_permission:add-slider', ['only' => ['create', 'store']]);
        $this->middleware('role_or_permission:edit-slider', ['only' => ['edit', 'update']]);
        $this->middleware('role_or_permission:delete-slider', ['only' => ['destroy']]);
        $this->middleware('role_or_permission:view-slider', ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the Slider.
     */
    public function index(Request $request)
    {
        return view('sliders.index');
    }

    /**
     * Show the form for creating a new Slider.
     */
    public function create()
    {
        session()->put('previous_url', url()->previous());
        return view('sliders.create');
    }

    /**
     * Store a newly created Slider in storage.
     */
    public function store(CreateSliderRequest $request)
    {
        $input = $request->all();

        $slider = $this->sliderRepository->create($input);
        if ($request->hasfile('image')) {
            $slider->image = uploadImage($request->file('image'), SLIDER_IMAGE_PATH);
        }
        $slider->new_window = $request->has('new_window') ? 1 : 0;
        $slider->save();

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['image' => $slider->image, 'title' => $slider->title])
            ->log('Slider - New slider created.');

        Flash::success('Slider saved successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('sliders.index'));
        return redirect($previousUrl);
    }

    /**
     * Display the specified Slider.
     */
    public function show($id)
    {
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            Flash::error('Slider not found');

            return redirect()->back();
        }

        return view('sliders.show')->with('slider', $slider);
    }

    /**
     * Show the form for editing the specified Slider.
     */
    public function edit($id)
    {
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            Flash::error('Slider not found');

            return redirect()->back();
        }

        session()->put('previous_url', url()->previous());
        return view('sliders.edit')->with('slider', $slider);
    }

    /**
     * Update the specified Slider in storage.
     */
    public function update($id, UpdateSliderRequest $request)
    {
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            Flash::error('Slider not found');

            return redirect()->back();
        }

        if ($request->hasfile('image')) {
            removeImage($slider->image, SLIDER_IMAGE_PATH);
        }
        $slider = $this->sliderRepository->update($request->all(), $id);

        if ($request->hasfile('image')) {
            $slider->image = uploadImage($request->file('image'), SLIDER_IMAGE_PATH);
        }
        $slider->new_window = $request->has('new_window') ? 1 : 0;
        $slider->save();

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['image' => $slider->image, 'title' => $slider->title])
            ->log('Slider - Slider details updated.');

        Flash::success('Slider updated successfully.');

        $previousUrl = session()->get('previous_url');
        session()->forget('previous_url', route('sliders.index'));
        return redirect($previousUrl);
    }

    /**
     * Remove the specified Slider from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $slider = $this->sliderRepository->find($id);

        if (empty($slider)) {
            Flash::error('Slider not found');

            return redirect()->back();
        }

        if (!empty($slider->image)) {
            removeImage($slider->image, SLIDER_IMAGE_PATH);
        }
        $this->sliderRepository->delete($id);

        // Log Activity
        activity()
            ->performedOn(getLoggedInUser())
            ->withProperties(['image' => $slider->image, 'title' => $slider->title])
            ->log('Slider - slider details removed.');

        Flash::success('Slider deleted successfully.');

        return redirect()->back();
    }
}
