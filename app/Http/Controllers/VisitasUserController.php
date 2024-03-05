<?php

namespace App\Http\Controllers;

use App\Http\Resources\VisitaCollection;
use App\Models\Visita;
use Illuminate\Http\Request;

class VisitasUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return new VisitaCollection(Visita::where('user_id', auth()->user()->id)->orderBy('created_at','desc')->paginate(50));
    }
}
