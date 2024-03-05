<?php

namespace App\Http\Controllers;

use App\Http\Resources\VisitaSalaCollection;
use App\Models\VisitaSala;
use Illuminate\Http\Request;

class VisitaSalaUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return new VisitaSalaCollection(VisitaSala::where('user_id', auth()->user()->id)->orderBy('created_at','desc')->paginate(50));
    }
}
