<?php

namespace App\Http\Controllers\Backend\AdsImage;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\AdsImageModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdsController extends Controller
{
    public function addImage(){
        // Check if an ad already exists and return for editing
        $ad = AdsImageModel::first();

        if ($ad) {
            return view('Backend.AdsImage.Add', ['ad' => $ad]);
        }

        // If no ad exists, return the empty view for creating new ad
        return view('Backend.AdsImage.Add');
    }

    public function save(Request $request){
        // Validate the request
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'ads_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Check if a record already exists
        $existingAd = AdsImageModel::first();

        if ($existingAd) {
            // Update the existing record
            return $this->updateAd($request, $existingAd->id);
        }

        // Create new record
        $save = new AdsImageModel();

        // Handle primary image upload
        if ($request->hasFile('image')) {
            $save->image = uploadImage($request->file('image'), 'adds', null, 'main');
        }

        // Handle ads image upload if provided
        if ($request->hasFile('ads_image')) {
            $save->ads_image = uploadImage($request->file('ads_image'), 'adds', null, 'ads');
        }

        // Set dates
        if ($request->start_date) {
            try {
                $start_date = Carbon::createFromFormat('d-m-Y', $request->start_date);
            } catch (\Exception $e) {
                try {
                    $start_date = Carbon::parse($request->start_date);
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['start_date' => 'Invalid date format']);
                }
            }
            $save->start_date = $start_date->format('Y-m-d');
        }

        if ($request->end_date) {
            try {
                $end_date = Carbon::createFromFormat('d-m-Y', $request->end_date);
            } catch (\Exception $e) {
                try {
                    $end_date = Carbon::parse($request->end_date);
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['end_date' => 'Invalid date format']);
                }
            }
            $save->end_date = $end_date->format('Y-m-d');
        }

        $save->save();

        Session::flash('success', "Ad has been created successfully");
        return redirect()->back();
    }

    public function edit($id)
    {
        $ad = AdsImageModel::findOrFail($id);
        return view('Backend.AdsImage.Add', ['ad' => $ad]);
    }

    public function updateAd(Request $request, $id){
        // Validate the request
        $this->validate($request, [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'ads_image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $update = AdsImageModel::findOrFail($id);

        // Handle primary image upload if provided
        if ($request->hasFile('image')) {
            $update->image = uploadImage(
                $request->file('image'),
                'adds',
                $update->image,
                'main'
            );
        }

        // Handle ads image upload if provided
        if ($request->hasFile('ads_image')) {
            $update->ads_image = uploadImage(
                $request->file('ads_image'),
                'adds',
                $update->ads_image,
                'ads'
            );
        }

        // Handle ads_image deletion
        if ($request->has('delete_ads_image') && $request->delete_ads_image == 1 && $update->ads_image) {
            // Delete ads image from storage
            deleteImage(getImageUrl('adds', $update->ads_image));

            // Clear the field
            $update->ads_image = null;
        }

        // Update dates
        if ($request->start_date) {
            try {
                $start_date = Carbon::createFromFormat('d-m-Y', $request->start_date);
            } catch (\Exception $e) {
                try {
                    $start_date = Carbon::parse($request->start_date);
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['start_date' => 'Invalid date format']);
                }
            }
            $update->start_date = $start_date->format('Y-m-d');
        }

        if ($request->end_date) {
            try {
                $end_date = Carbon::createFromFormat('d-m-Y', $request->end_date);
            } catch (\Exception $e) {
                try {
                    $end_date = Carbon::parse($request->end_date);
                } catch (\Exception $e) {
                    return redirect()->back()->withErrors(['end_date' => 'Invalid date format']);
                }
            }
            $update->end_date = $end_date->format('Y-m-d');
        }

        $update->save();

        Session::flash('success', "Ad has been updated successfully");
        return redirect()->back();
    }

    // Handle update request directly from route
    public function update(Request $request, $id){
        return $this->updateAd($request, $id);
    }
}
