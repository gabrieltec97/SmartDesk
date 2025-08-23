<?php

namespace App\Http\Controllers;

use App\Models\take;
use Illuminate\Http\Request;

class TakeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('takes.takes-management');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('takes.new-take');
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
    public function show(take $take)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(take $take)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, take $take)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(take $take)
    {
        //
    }
}
