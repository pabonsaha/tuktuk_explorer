<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;
use App\Models\Banner;
use App\Models\Hour;
use App\Models\Tour;
use App\Models\TourAdditional;
use Illuminate\Http\Request;
use App\Exceptions;

class TourHourController extends Controller
{
    use FileUploadTrait;

    public function index($id)
    {
        $hours = Hour::where("tour_id",$id)->latest()->paginate(10);
        $tour = Tour::find($id);
        return view('admin.tour.hours.index', compact('hours', 'tour'));
    }

    public function store(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
                'number_of_people' => 'required|integer|min:0',
                'price' => 'required|numeric|min:0',
                'is_active' => 'required|boolean',
            ]);

            $tour = Tour::find($id);

            $tourHour = new Hour();
            $tourHour->tour_id = $tour->id;
            $tourHour->title = $request->title;
            $tourHour->description = $request->description;
            $tourHour->price = $request->price;
            $tourHour->number_of_people = $request->number_of_people;
            $tourHour->is_active = $request->is_active;

            if ($request->hasFile('thumbnail')) {
                $path = $this->uploadFile($request->file('thumbnail'), 'tours/' . $tour->id . '/hours');
                $tourHour->thumbnail = $path;
            }

            $tourHour->save();
            return redirect()->route('admin.tour.hour.index', $tour->id)->with('success', 'Tour Hour created successfully!');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }

    public function edit($tour_id, $id)
    {
        $hour = Hour::findOrFail($id);
        return response()->json($hour);
    }


    public function update(Request $request, $tour_id, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'number_of_people' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        $tour = Tour::find($tour_id);

        $tourHour = Hour::find($id);
        $tourHour->tour_id = $tour->id;
        $tourHour->title = $request->title;
        $tourHour->description = $request->description;
        $tourHour->price = $request->price;
        $tourHour->number_of_people = $request->number_of_people;
        $tourHour->is_active = $request->is_active;

        if ($request->hasFile('thumbnail')) {
            $path = $this->uploadFile($request->file('thumbnail'), 'tours/' . $tour->id . '/hours');
            $this->deleteFile($tourHour->thumbnail);
            $tourHour->thumbnail = $path;
        }

        $tourHour->save();
        session()->flash('success', 'Tour Hour updated successfully!');
        return response()->json([
            'success' => true,
            'message' => 'Tour Hour Updated Successfully',
        ]);
    }

    public function destroy($tour_id, $id)
    {
        $hour = Hour::find($id);

        if (!$hour) {
            return response()->json([
                'success' => false,
                'message' => 'Hour not found.'
            ], 404);
        }

        $hour->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hour deleted successfully.'
        ]);
    }

}
