<?php

namespace App\Http\Controllers\Backend\About;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class AboutController extends Controller
{
    public function allAbout(){
        // Get the first About record or create an empty record if none exists
        $records = About::first();

        // Return view with the record (existing or empty)
        return view('Backend.About.aboutus', compact('records'));
    }

    public function saveOrUpdateAbout(Request $request){
        // Validate the request
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,svg|max:2048',
        ]);

        // Check if a record already exists
        $existingRecord = About::first();

        if ($existingRecord) {
            // Update existing record
            $existingRecord->title = $request->get('title');
            $existingRecord->description = $request->get('content');

            // Handle image upload or deletion
            if ($request->hasFile('image')) {
                // Upload new image
                $existingRecord->image = uploadImage($request->file('image'), 'aboutus', $existingRecord->image, 'aboutus');
            } else if ($request->input('delete_image') == 1 && $existingRecord->image) {
                // Delete image if requested
                deleteImage(getImageUrl('aboutus', $existingRecord->image));
                $existingRecord->image = null;
            }

            $existingRecord->save();
            Session::flash('success', "About us content has been updated successfully");
        } else {
            // Create new record
            $save = new About();
            $save->title = $request->get('title');
            $save->description = $request->get('content');

            if ($request->hasFile('image')) {
                $save->image = uploadImage($request->file('image'), 'aboutus', null, 'aboutus');
            }

            $save->save();
            Session::flash('success', "About us content has been created successfully");
        }

        return redirect()->route('allAbout');
    }

    // Keep these methods for backward compatibility, but they will redirect to our single page approach
    public function addAbout(){
        return redirect()->route('allAbout');
    }

    public function saveAbout(Request $request){
        return $this->saveOrUpdateAbout($request);
    }

    public function editAbout($id=null){
        return redirect()->route('allAbout');
    }

    public function updateAbout(Request $request, $id=null){
        return $this->saveOrUpdateAbout($request);
    }

    public function deleteAbout($id=null){
        $remove = About::findOrFail($id);

        // Delete the image if it exists
        if ($remove->image) {
            deleteImage(getImageUrl('aboutus', $remove->image));
        }

        $remove->delete();
        Session::flash('success', "About us content has been deleted");
        return redirect()->route('allAbout');
    }
}
