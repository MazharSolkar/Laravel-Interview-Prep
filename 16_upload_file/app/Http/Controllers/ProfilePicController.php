<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProfilePic;

class ProfilePicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profilePics = ProfilePic::all();
        return view('home', compact('profilePics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('upload-pic');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $fileds = $request->validate([
            'photo' => 'required|mimes:jpg,png,jpeg,|max:3000',
        ]);

        // store the file using public driver inside storage folder
        // link storage folder with public folder: php artisan Storage:link
        $image_path = $request->photo->store('images', 'public');
        // store method will store image in storage/public/images folder when public drive is used.

        // basename removes the path from file name.
        $image_name = basename($image_path);

        // store the image in database.
        ProfilePic::create([
            'profile_pic' => $image_name
        ]);

        return redirect()->route('profile-pic.index')->with(['status' => 'Profile Picture Uploaded.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $profilePic = ProfilePic::find($id);

        return view('update-pic', compact('profilePic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $fields = $request->validate([
            'photo' => 'nullable|mimes:jpg,png,jpeg|max:3000',
        ]);

        // check if the photo attribute is not null
        if($request->hasFile('photo')) {
            $profilePic = ProfilePic::find($id);

            // delete the image from public/storage/images folder
            $image_path = public_path("storage/images/$profilePic->profile_pic");
            if (file_exists($image_path)) {
                @unlink($image_path);
            }

            // store updated image in public/storage/images folder
            $image_path = $request->photo->store('images', 'public');
            $image_name = basename($image_path);

            // store the updated image in database.
            $profilePic->update([
                'profile_pic' => $image_name,
            ]);
            return redirect()->route('profile-pic.index')->with('status', 'profile pic updated.');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profilePic = ProfilePic::find($id);

        $image_path = public_path("storage/images/$profilePic->profile_pic");
        if(file_exists($image_path)) {
            @unlink($image_path);
        }

        $profilePic->delete();

        return redirect()->back();
        
    }
}
