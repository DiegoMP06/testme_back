<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use App\Models\TestVersion;
use Illuminate\Http\Request;
use App\Http\Resources\SalaCollection;
use App\Http\Resources\TestVersionCollection;

class HomeController extends Controller
{
    public function tests(Request $request) 
    {
        return new TestVersionCollection(TestVersion::when($request->busqueda, function($query, $busqueda) {
                $query->where('nombre', 'LIKE', "%" . $busqueda . "%");
            })
            ->when($request->categoria_id, function($query, $categoria_id) {
                $query->where('categoria_id', $categoria_id);
            })
            ->when($request->tipo_id, function($query, $tipo_id) {
                $query->where('tipo_id', $tipo_id);
            })
            ->where('publico', 1)
            ->orderBy('id', 'DESC')
            ->paginate(40)
        );
    }


    public function salas(Request $request)
    {
        return new SalaCollection(Sala::when($request->busqueda, function($query, $busqueda) {
                $query->where('nombre', 'LIKE', "%" . $busqueda . "%");
            })
            ->where('acceso', 1)
            ->orderBy('id', 'DESC')
            ->paginate(40)
        );
    }
}
