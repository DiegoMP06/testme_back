<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestSalaCollection;
use App\Models\TestVersion;
use App\Models\TestSala;
use Illuminate\Http\Request;

class TestSalaUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TestVersion $testVersion)
    {
        $this->authorize('viewAny', [TestSala::class, $testVersion, true]);

        return new TestSalaCollection(TestSala::where('test_version_id', $testVersion->id)->orderBy('id', 'DESC')->paginate(20));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TestVersion $testVersion, TestSala $testSala)
    {
        $this->authorize('view', [$testSala, $testVersion]);

        return new TestSalaCollection([$testSala]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TestSala $testSala)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestVersion $testVersion, TestSala $testSala)
    {
        $this->authorize('delete', [$testSala, $testVersion, true]);

        $testSala->delete();

        return response()->noContent();
    }
}
