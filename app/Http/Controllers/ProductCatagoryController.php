<?php

namespace App\Http\Controllers;

use App\Models\ProductCatagory;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Enums\Content;
use Illuminate\Http\Request;

class ProductCatagoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::ProductCatagory)) {
            $productcatagories = ProductCatagory::where('status', true)->get();
            return view('productcatagories.index', compact('productcatagories'));
        }
        return view('home');
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
        $user = auth()->user();
        if ($user->canCreate(Content::Product)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            try {
                ProductCatagory::create($data);
            } catch(Exception $e) {
                return redirect()->route('productcatagories.index')
                                 ->with('insert-error', 'insert error');
            }
        }
        return redirect()->route('productcatagories.index')
                         ->with('insert-success', 'insert OK');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCatagory  $productCatagory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCatagory $productcatagory)
    {
        $user = auth()->user();
        if ($user->canRead(Content::ProductCatagory)) {
            return view('productcatagories.show', compact('productcatagory'));
        }
        return view('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCatagory  $productCatagory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCatagory $productcatagory)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::ProductCatagory)) {
            return view('productcatagories.edit', compact('productcatagory'));
        }
        return redirect()->route('productcatagories.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCatagory  $productCatagory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCatagory $productcatagory)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::ProductCatagory)) {
            $data = $request->all();
            try {
                $productcatagory->update($data);
            } catch(Exception $e) {
                return redirect()->route('productcatagories.index')
                                 ->with('update-error', 'update error');
            }
        }
        return redirect()->route('productcatagories.index')
                         ->with('update-success', 'update OK');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCatagory  $productCatagory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCatagory $productcatagory)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::ProductCatagory)) {
            $productcatagory->delete();
        } else if ($user->canDisable(Content::ProductCatagory)) {
            $productcatagory->status = false;
            $productcatagory->save();
        }
        return redirect()->route('productcatagories.index');
    }
}
