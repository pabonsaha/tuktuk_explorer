<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\FileUploadTrait;
use App\Models\Banner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Exceptions;

class BannerController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        $banners = Banner::paginate(10);
        return view('admin.banner.index', compact('banners'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:2048',
                'is_active' => 'required|boolean',
            ]);

            $banner = new Banner();
            $banner->title = $request->title;
            $banner->is_active = $request->is_active;

            if ($request->hasFile('image')) {
                $path = $this->uploadFile($request->file('image'), 'banners');
                $banner->image = $path;
            }

            $banner->save();
            return redirect()->route('admin.banner.index')->with('success', 'Banner created successfully!');
        } catch (Exceptions $exception) {
            return redirect()->back()->with('error', "Something Went Wrong");
        }
    }

    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return response()->json($banner);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        $banner = Banner::findOrFail($id);
        $banner->title = $validated['title'];
        $banner->is_active = $validated['is_active'];

        if ($request->hasFile('image')) {
            $path = $this->uploadFile($request->file('image'), 'banners');
            $this->deleteFile($banner->image);
            $banner->image = $path;
        }

        $banner->save();
        return response()->json([
            'success' => true,
            'message' => 'Banner Updated Successfully',
        ]);
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);

        if (!$banner) {
            return response()->json([
                'success' => false,
                'message' => 'Banner not found.'
            ], 404);
        }

        // Optional: Delete image if stored in filesystem
        if ($banner->image) {
            $this->deleteFile($banner->image);
        }

        $banner->delete();

        return response()->json([
            'success' => true,
            'message' => 'Banner deleted successfully.'
        ]);
    }

}
