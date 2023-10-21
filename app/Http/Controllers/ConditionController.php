<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condition;
class ConditionController extends Controller
{
    public function index()
    {
        $conditions = Condition::all();
        return response()->json(['conditions' => $conditions]);
    }

    public function show($id)
    {
        $condition = Condition::findOrFail($id);
        return view('conditions.show', compact('condition'));
    }
}
