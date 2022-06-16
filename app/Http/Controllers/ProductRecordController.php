<?php

namespace App\Http\Controllers;

use App\Models\ProductRecord;
use Illuminate\Http\Request;

class ProductRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productrecords = ProductRecord::get();

        return view('productrecords.index', compact('productrecords'));
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
     * @param  \App\Models\ProductRecord  $productRecord
     * @return \Illuminate\Http\Response
     */
    public function show(ProductRecord $productRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductRecord  $productRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductRecord $productRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductRecord  $productRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductRecord $productRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductRecord  $productRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductRecord $productRecord)
    {
        //
    }
}
