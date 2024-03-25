<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    function display(User $user)
    {
        $fields = $user->getFields();

        return view('profile', [
            'fields' => $fields
        ]);
    }
}
