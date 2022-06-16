<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use App\Models\ProductCatagory;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Enums\Content;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suser = auth()->user();

        if ($suser->canRead(Content::ProductType)) {
            $productcatagories = ProductCatagory::where('status', true)->get();
            $producttypes = ProductType::where('status', true)->get();

            return view('producttypes.index', compact('producttypes'))
                   ->with(compact('productcatagories'));
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
        if ($user->canCreate(Content::ProductType)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $user->id;
            try {
                ProductType::create($data);
            } catch(Exception $e) {
                return redirect()->route('producttypes.index')
                                 ->with('insert-error', 'insert error');
            }
        }
        return redirect()->route('producttypes.index')
                         ->with('insert-success', 'insert OK');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function show(ProductType $producttype)
    {
        $user = auth()->user();
        if ($user->canRead(Content::ProductType)) {
            return view('producttypes.show', compact('producttype'));
        }
        return redirect()->route('producttypes.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductType $producttype)
    {
        $user = auth()->user();
        if ($user->canRead(Content::ProductType)) {
            return view('producttypes.edit', compact('producttype'));
        }
        return redirect()->route('producttypes.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductType $producttype)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::ProductType)) {
            $data = $request->all();
            try {
                $producttype->update($data);
            } catch(Exception $e) {
                return redirect()->route('producttypes.index')
                                 ->with('update-error', 'update error');
            }

        }
        return redirect()->route('producttypes.index')
                         ->with('update-success', 'update OK');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductType  $productType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductType $producttype)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::ProductType)) {
            $producttype->delete();
        } else if ($user->canDisable(Content::ProductType)) {
            $producttype->status = false;
            $producttype->save();
        }
        return redirect()->route('producttypes.index');
    }
}
