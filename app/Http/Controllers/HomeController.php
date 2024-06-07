<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\TypeSocial;
use App\Models\User;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        $social = $user->socialMedia()->get();
        $actions = $user->actions()->get();
        $types = TypeSocial::all();
        return view('home', compact('user', 'types', 'social', 'actions'));
    }
    
    public function update(Request $request)
    {
        $social_media = $request->except('_token', 'first_name', 'last_name', 'photo', 'type_photo', 'bio', 'email', 'phone', 'password', 'password_confirmation', 'use_Whatsapp', 'use_Gmail', 'socialMedia');
        $id = Auth::user()->id;

        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'string|nullable',
            'last_name' => 'string|nullable',
            'photo' => 'string|nullable',
            'type_photo' => 'string|nullable',
            'bio' => 'string|nullable',
            'email' => 'email|unique:users,email,' . $id,
            'phone' => 'string|unique:users,phone,' . $id . '|nullable',
            'password' => 'string|nullable|min:6|confirmed',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);
        if ($request->hasFile('photo') && $request->type_photo === 'upload') {
            // Handle the file if it's an upload type
            $filePath = $request->file('photo')->store('profile', 'public'); // Adjust the storage path as needed
            $user->photo = $filePath;
            $user->type_photo = 'upload';
        } elseif ($request->type_photo === 'url') {
            // Handle the URL if it's a URL type
            $user->photo = $request->photo;
            $user->type_photo = 'url';
        }

        // Update user's WhatsApp and Gmail settings
        $user->use_Whatsapp = $request->has('use_Whatsapp');
        $user->use_Gmail = $request->has('use_Gmail');
        $user->save();
        foreach ($user->socialMedia()->get() as $value) {
            if (!key_exists($value->name, $social_media)) {
                $sc = SocialMedia::find($value->id);
                $sc->delete();
            }
        }
        $typessoc = TypeSocial::all('name');
        $types = [];
        foreach ($typessoc as $key => $value) {
            array_push($types, $value->name);
        }
        // Update or create social media links
        foreach ($social_media as $key => $value) {
            if (in_array($key, $types)) {
                SocialMedia::updateOrCreate(
                    ['user_id' => $user->id, 'name' => $key],
                    ['url' => $value]
                );
            }
        }
        $filteredValues = [];

        foreach ($social_media as $key => $value) {
            if (strpos($key, 'name-Link') === 0) {
                $filteredValues[] = $value;
            }
        }
        foreach ($user->actions()->get() as $value) {
            if (!key_exists($value->name, $filteredValues)) {
                $sc = Action::find($value->id);
                $sc->delete();
            }
        }
        foreach ($social_media as $key => $value) {
            // Check if the key starts with 'name-' to identify link sections
            if (strpos($key, 'name-') === 0 && $value) {
                // Extract the index from the key
                $index = str_replace('name-Link', '', $key);

                // Handle the data for the link section with this index
                $name = $value;
                $typeKey = "type-Link{$index}";
                $type = $request->input($typeKey);

                // Find or create a SocialMedia object based on the name
                $Action = Action::updateOrCreate(['user_id' => $user->id, 'name' => $name, 'type' => $type]);

                // Update the fields based on the type
                if ($type === 'upload') {
                    $fileKey = "file-Link{$index}";
                    $file = $request->file($fileKey);
                    if ($file) {
                        $filePath = $request->file('url')->store('document', 'public'); // Adjust the storage path as needed
                        $Action->url = $filePath;
                    }
                    $Action->type = 'upload';
                } elseif ($type === 'url') {
                    $fileKey = "file-Link{$index}";
                    $file = $request->input($fileKey);
                    // Handle the URL if it's a URL type
                    $Action->url = $file;
                    $Action->type = 'url';
                }
                $Action->save();
            }
        }
        // Update the user with the validated data
        $user->update($validatedData);

        return redirect()->route('home')->with('success', 'User updated successfully');
    }
}
