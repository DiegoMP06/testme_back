<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserSalaCollection;
use App\Models\UserSala;
use Illuminate\Http\Request;

class SalasUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return new UserSalaCollection(UserSala::where('user_id', auth()->user()->id)->paginate(20));
    }
}
