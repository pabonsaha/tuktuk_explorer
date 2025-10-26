<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;
use App\Models\Banner;
use App\Models\Tour;
use App\Models\TourAdditional;
use Illuminate\Http\Request;

class TourAdditionalController extends Controller
{
    use FileUploadTrait;

    public function index($id)
    {
        $additionals = TourAdditional::where("tour_id", $id)->latest()->paginate(10);
        $tour = Tour::find($id);
        return view('admin.tour.additional.index', compact('additionals', 'tour'));
    }

    public function store(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:255',
                'price' => 'required|numeric|min:0',
                'is_active' => 'required|boolean',
            ]);

            $tour = Tour::find($id);

            $tourAdditional = new TourAdditional();
            $tourAdditional->tour_id = $tour->id;
            $tourAdditional->title = $request->title;
            $tourAdditional->description = $request->description;
            $tourAdditional->price = $request->price;
            $tourAdditional->is_active = $request->is_active;
            $tourAdditional->save();
            return redirect()->route('admin.tour.additional.index', $tour->id)->with('success', 'Tour Additional created successfully!');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }

    public function edit($tour_id, $id)
    {
        $hour = TourAdditional::findOrFail($id);
        return response()->json($hour);
    }


    public function update(Request $request, $tour_id, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        $tour = Tour::find($tour_id);

        $tourHour = TourAdditional::find($id);
        $tourHour->tour_id = $tour->id;
        $tourHour->title = $request->title;
        $tourHour->description = $request->description;
        $tourHour->price = $request->price;
        $tourHour->is_active = $request->is_active;
        $tourHour->save();

        session()->flash('success', 'Tour Additional updated successfully!');
        return response()->json([
            'success' => true,
            'message' => 'Additional Updated Successfully',
        ]);
    }

    public function destroy($tour_id, $id)
    {
        $tourAdditionl = TourAdditional::find($id);

        if (!$tourAdditionl) {
            return response()->json([
                'success' => false,
                'message' => 'Additional not found.'
            ], 404);
        }


        $tourAdditionl->delete();

        return response()->json([
            'success' => true,
            'message' => 'Additional deleted successfully.'
        ]);
    }

}
