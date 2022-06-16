<?php

namespace App\Http\Controllers;

use App\Models\ProductStatus;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Enums\Content;
use Illuminate\Http\Request;

class ProductStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suser = auth()->user();
        if ($suser->canRead(Content::ProductStatus)) {
            $productstatuses = ProductStatus::where('status', true)->get();
            return view('productstatuses.index', compact('productstatuses'));
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
        $suser = auth()->user();
        if ($suser->canCreate(Content::ProductStatus)) {
            $data = $request->all();
            $data['status'] = true;
            $data['created_by'] = $suser->id;
            try {
                ProductStatus::create($data);
            } catch(Exception $e) {
                return redirect()->route('productstatuses.index')
                                 ->with('insert-error', 'insert error');
            }
        }
        return redirect()->route('productstatuses.index')
                         ->with('insert-success', 'insert OK');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductStatus  $productStatus
     * @return \Illuminate\Http\Response
     */
    public function show(ProductStatus $productstatus)
    {
        $suser = auth()->user();
        if ($suser->canRead(Content::ProductStatus)) {
            return view('productstatuses.show', compact('productstatus'));
        }
        return redirect()->route('productstatuses.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductStatus  $productStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductStatus $productstatus)
    {
        $suser = auth()->user();
        if ($suser->canUpdate(Content::ProductStatus)) {
            return view('productstatuses.edit', compact('productstatus'));
        }
        return redirect()->route('productstatuses.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductStatus  $productStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductStatus $productstatus)
    {
        $suser = auth()->user();
        if ($suser->canUpdate(Content::ProductStatus)) {
            $data = $request->all();
            try {
                $productstatus->update($data);
            } catch(Exception $e) {
                return redirect()->route('productstatuses.index')
                                 ->with('update-error', 'update error');
            }
        }
        return redirect()->route('productstatuses.index')
                         ->with('update-success', 'update OK');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductStatus  $productStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductStatus $productstatus)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::ProductStatus)) {
            $productstatus->delete();
        } else if ($user->canDisable(Content::ProductStatus)) {
            $productstatus->status = false;
            $productstatus->save();
        }

        return redirect()->route('productstatuses.index');
    }
}
