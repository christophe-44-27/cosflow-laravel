<?php

namespace App\Http\Controllers;

use App\Resources\UserProfileResource;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * @return UserProfileResource
     */
    public function displayProfile()
    {
        return UserProfileResource::make(Auth::user());
    }
}
