<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDirectionRequest;
use App\Http\Requests\UpdateDirectionRequest;
use App\Models\Direction;

class DirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $direction = Direction::all();
        return view('layouts.main' , 'directions');
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
    public function store(StoreDirectionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Direction $direction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Direction $direction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDirectionRequest $request, Direction $direction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Direction $direction)
    {
        //
    }
}
