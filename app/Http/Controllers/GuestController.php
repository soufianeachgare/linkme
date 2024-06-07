<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\TypeSocial;
use App\Models\User;
use App\Models\SocialMedia;

class GuestController extends Controller
{
    

public function getUser($id)
{
    $user = User::find($id);

    if ($user) {
        $social = $user->socialMedia()->get();
        $actions = $user->actions()->get();
        $types = TypeSocial::all();
        return view('detail', compact('user', 'types', 'social', 'actions'));
    } else {
        // User not found, redirect to a 404 page
        return abort(404);
    }
}

}
