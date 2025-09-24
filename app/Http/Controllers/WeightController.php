<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use Illuminate\Http\Request;

class WeightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Weight::all();
        return view('weights.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('weights.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = new Weight();
        $item->name = $request->name;
        $item->status = $request->status;
        $item->save();

        return redirect('/weights')->with('success', 'Weight created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Weight $weight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $weight = Weight::find($id);
        return view('weights.edit', compact('weight'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Weight::findOrFail($id);
        $item->name = $request->name;
        $item->status = $request->status;
        $item->save();

        return redirect('/weights')->with('success', 'Weight updated successfully.');
    }
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Weight::findOrFail($id);
        $item->delete();

        return redirect('/weights')->with('success', 'Weight deleted successfully.');
    }

}
    