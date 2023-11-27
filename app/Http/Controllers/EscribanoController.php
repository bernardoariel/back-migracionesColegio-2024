<?php

namespace App\Http\Controllers;

use App\Models\Escribano;
use Illuminate\Http\Request;

class EscribanoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $escribanos = Escribano::all();
        return response()->json(['escribanos' => $escribanos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
        $escribano = Escribano::findOrFail($id);
        return response()->json($escribano);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
