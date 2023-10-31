<?php

namespace App\Http\Controllers;

use App\Models\problem;
use App\Http\Requests\StoreproblemRequest;
use App\Http\Requests\UpdateproblemRequest;

class ProblemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreproblemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(problem $problem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(problem $problem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproblemRequest $request, problem $problem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(problem $problem)
    {
        //
    }
}
