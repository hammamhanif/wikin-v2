<?php

namespace App\Http\Controllers;

use App\Models\galleries;
use App\Models\Communities;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    public function index($slug)
    {
        // Retrieve the community based on the slug
        $community = Communities::where('slug', $slug)->firstOrFail();
        $galleries = Galleries::where('community_id', $community->id)->get();

        return view('tamplate.dashboard.menu.addGaleryCommunity', compact('community', 'galleries'));
    }
    public function indexLanding($slug)
    {
        // Retrieve the community based on the slug
        $community = Communities::where('slug', $slug)->where(function ($query) {
            $query->where('status', 'active')
                ->orWhere('status', 'verifikasi');
        })->firstOrFail();

        // Check if the community status is inactive or verification, then abort with 404
        if ($community->status === 'inactive' || $community->status === 'verifikasi') {
            abort(404);
        }

        $galleries = Galleries::where('community_id', $community->id)->get();

        return view('komunitas.communitiyGaleri', compact('community', 'galleries'));
    }
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'community_id' => 'required|exists:communities,id',
            // You can add more validation rules here if needed
        ]);

        // Store the image in storage/app/public/images directory
        $imagePath = $request->file('image')->store('images/galeri', 'public');

        // Create the gallery
        galleries::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $imagePath,
            'community_id' => $validatedData['community_id'],
            'user_id' => auth()->id(), // Assuming you're using authentication
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Gallery has been created successfully!');
    }

    public function delete($id)
    {
        // Find the gallery by id
        $gallery = Galleries::findOrFail($id);

        // Check if the authenticated user is authorized to delete the gallery
        // You may adjust this authorization logic based on your requirements
        if ($gallery->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this gallery.');
        }

        // Delete the image file from storage
        Storage::disk('public')->delete($gallery->image);

        // Delete the gallery from the database
        $gallery->delete();

        return redirect()->back()->with('success', 'Gallery has been deleted successfully.');
    }
}
