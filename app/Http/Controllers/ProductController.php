<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductStatus;
use App\Models\ProductRecord;
use App\Models\User;
use App\Models\Project;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Enums\Content;
use App\Libs\MAC;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::orderBy('id', 'DESC')->get();
        $productstatuses = ProductStatus::where('status', true)->get();
        $producttypes = ProductType::where('status', true)->get();
        $projects = Project::where('status', true)->get();

        return view('products.index', compact('products'))
               ->with(compact('productstatuses'))
               ->with(compact('producttypes'))
               ->with(compact('projects'));
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
            $indata = $request->all();
            $indata['created_by'] = $user->id;
            $product = Product::create($indata);
            unset($indata['_token']);
            $data = array(
                  'product_id' => $product->id,
                  'from'       => 'browser',
                  'data'       => json_encode($indata),
                  'result'     => 'Insert OK',
                  'created_by' => $user->id,
            );
            ProductRecord::create($data);
        }
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $user = auth()->user();
        if ($user->canRead(Content::Product)) {
            return view('products.show', compact('product'));
        }
        return redirect()->route('products.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Product)) {
            $producttypes = ProductType::where('status', true)->get();
            $projects = Project::where('status', true)->get();
            $productstatuses = ProductStatus::where('status', true)->get();

            return view('products.edit', compact('product'))
                   ->with(compact('projects'))
                   ->with(compact('producttypes'))
                   ->with(compact('productstatuses'));
        }
        return redirect()->route('products.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $user = auth()->user();
        if ($user->canUpdate(Content::Product)) {
            $indata = $request->all();
            $product->update($indata);
            unset($indata['_token']);
            unset($indata['_method']);
            $data = array(
                  'product_id' => $product->id,
                  'from'       => 'browser',
                  'data'       => json_encode($indata),
                  'result'     => 'Update OK',
                  'created_by' => $user->id,
            );
            ProductRecord::create($data);
        }
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::Product)) {
            $product->delet();
        } else if ($user->canDisable(Content::Product)) {
            $product->status = false;
            $product->save();
        }
        return redirect()->route('products.index');
    }
}
