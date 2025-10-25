<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Http\Traits\FileUploadTrait;
use App\Models\Tour;
use App\Models\TourImages;
use Brian2694\Toastr\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{

    use FileUploadTrait;

    public function index()
    {
        $tours = Tour::latest()->paginate(10);
        return view('admin.tour.index', compact('tours'));
    }

    public function create()
    {
        return view('admin.tour.create');
    }

    public function store(StoreTourRequest $request)
    {
        try {
            DB::beginTransaction();
            $tour = new Tour();
            $tour->title = $request->title;
            $tour->description = $request->description;
            $tour->tour_duration = $request->tour_duration;
            $tour->starting_price = $request->starting_price;
            $tour->num_of_people = $request->num_of_people;
            $tour->note = $request->note;


            $tour->specifications = json_encode($request->specifications) ?? [];
            $tour->requirements = json_encode($request->requirements) ?? [];
            $tour->tour_highlights = json_encode($request->tour_highlights) ?? [];
            $tour->meeting_point = json_encode($request->meeting_point) ?? [];

            $tour->is_active = 0;

            if ($request->hasFile('thumbnail')) {
                // Note: Assuming $this->uploadFile() is a valid method on your controller
                $path = $this->uploadFile($request->file('thumbnail'), 'tours');
                $tour->thumbnail = $path;
            }

            $tour->save();


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $this->uploadFile($image, 'tours/' . $tour->id);
                    $tourImage = new TourImages();
                    $tourImage->image = $path;
                    $tourImage->tour_id = $tour->id;
                    $tourImage->save();
                }
            }
            DB::commit();

            session()->flash('success', 'Tour created successfully.');
            return response()->json([
                'message' => 'Tour created successfully.',
                'status' => true,
            ], 200);

        } catch (\Exception $e) {

            DB::rollBack();
            return response([
                'message' => 'Something went wrong: ' . $e->getMessage(), // Provide more detail for debugging
                'status' => false,
            ], 500);
        }

    }

    public function edit($id)
    {
        try {
            $tour = Tour::where('id', $id)->with('images')->first();
            return view('admin.tour.edit', compact('tour'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Not Found');
        }
    }

    public function update(UpdateTourRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $tour = Tour::find($id);
            $tour->title = $request->title;
            $tour->description = $request->description;
            $tour->tour_duration = $request->tour_duration;
            $tour->starting_price = $request->starting_price;
            $tour->num_of_people = $request->num_of_people;
            $tour->note = $request->note;


            $tour->specifications = json_encode($request->specifications) ?? [];
            $tour->requirements = json_encode($request->requirements) ?? [];
            $tour->tour_highlights = json_encode($request->tour_highlights) ?? [];
            $tour->meeting_point = json_encode($request->meeting_point) ?? [];


            if ($request->hasFile('thumbnail')) {
                // Note: Assuming $this->uploadFile() is a valid method on your controller
                $path = $this->uploadFile($request->file('thumbnail'), 'tours');
                $tour->thumbnail = $path;
            }

            $tour->save();

            if ($request->filled('deleted_images')) {
                $ids = explode(',', $request->deleted_images);
                $tourImges = TourImages::whereIn('id', $ids)->get();
                foreach ($tourImges as $tourImage) {
                    $this->deleteFile($tourImage->image);
                    $tourImage->delete();
                }
            }


            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $this->uploadFile($image, 'tours/' . $tour->id);
                    $tourImage = new TourImages();
                    $tourImage->image = $path;
                    $tourImage->tour_id = $tour->id;
                    $tourImage->save();
                }
            }
            DB::commit();
            session()->flash('success', 'Tour updated successfully.');
            return response()->json([
                'message' => 'Tour Updated Successfully.',
                'status' => true,
            ], 200);

        } catch (Excepiton  $e) {
            return redirect()->back()->with('error', 'Not Found');
        }


    }

    public function toggleStatus(Request $request, Tour $tour)
    {
        $tour->is_active = $request->boolean('is_active');
        $tour->save();

        return response()->json(['message' => 'Tour status updated successfully.']);
    }

}
