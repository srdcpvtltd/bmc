<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EstablishmentShop;
use Illuminate\Http\Request;

class EstablishmentShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $establishment_shops = EstablishmentShop::all();
            return response([
                "establishment_shops" => $establishment_shops,
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
     * @param  \App\Models\EstablishmentShop  $establishmentShop
     * @return \Illuminate\Http\Response
     */
    public function show(EstablishmentShop $establishmentShop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EstablishmentShop  $establishmentShop
     * @return \Illuminate\Http\Response
     */
    public function edit(EstablishmentShop $establishmentShop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EstablishmentShop  $establishmentShop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstablishmentShop $establishmentShop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstablishmentShop  $establishmentShop
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstablishmentShop $establishmentShop)
    {
        //
    }
}
