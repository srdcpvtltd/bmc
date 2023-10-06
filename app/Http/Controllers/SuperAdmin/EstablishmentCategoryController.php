<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\EstablishmentCategory;
use Exception;
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
        return view('super_admin.establishment_category.index');
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
        try{
            $this->validate($request,[
                'name' => 'required',
            ]);
            EstablishmentCategory::create($request->all());
            toastr()->success('Establishment Category Added Successfully');
            return redirect()->back();
        }catch (Exception $e)
        {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
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
    public function update(Request $request,$id)
    {
        $establishmentCategory = EstablishmentCategory::find($id);
        $establishmentCategory->update($request->all());
        toastr()->success('Establishment Category Updated successfully');
        return redirect()->back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstablishmentCategory  $establishmentCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $establishmentCategory = EstablishmentCategory::find($id);
        $establishmentCategory->delete();
        toastr()->success('Establishment Category Deleted successfully');
        return redirect()->back();
    }
}
