<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EstablishmentCategory;
use Illuminate\Http\Request;

class EstablishmentCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $establishmentCategories = EstablishmentCategory::all();
            return response([
                "establishmentCategories" => $establishmentCategories,
            ], 200);
        } catch (\Exception $e) {
            return response([
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EstablishmentCategory  $establishmentCategory
     * @return \Illuminate\Http\Response
     */
    public function show(EstablishmentCategory $establishmentCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EstablishmentCategory  $establishmentCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(EstablishmentCategory $establishmentCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EstablishmentCategory  $establishmentCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstablishmentCategory $establishmentCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstablishmentCategory  $establishmentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstablishmentCategory $establishmentCategory)
    {
        //
    }
}
