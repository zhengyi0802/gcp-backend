<?php

namespace App\Http\Controllers;

use App\Models\LogMessage;
use App\Models\Product;
use App\Models\User;
use App\Enums\UserRole;
use App\Enums\Permission;
use App\Enums\Content;
use Illuminate\Http\Request;

class LogMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->canRead(Content::LogMessage)) {
            $logmessages = LogMessage::get();

            return view('logmessages.index', compact('logmessages'));
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
        $user = auth()->user();
        if ($user->canCreate(Content::LogMessage)) {
            return view('logmessages.create');
        }
        return redirect()->route('logmessages.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();
        $data['product_id'] = null;
        $data['serialno'] = strtoupper($data['sn']);
        $data['ether']    = strtoupper($data['mac_eth']);
        $data['wifi']     = strtoupper($data['mac_wifi']);
        $product = Product::where('serialno', $data['serialno'])
                          ->orWhere('ether_mac', $data['ether'])
                          ->orWhere('wifi_mac', $data['wifi'])
                          ->first();
        if ($product != null) {
            $data['product_id'] = $product->id;
        }
        LogMessage::create($data);
        return redirect()->route('logmessages.index');
    }

    public function browse(Request $request)
    {
        $id = $request->input('id');
        $product = Product::find($id);
        $logmessages = LogMessage::where('product_id', $id)->get();

        return view('logmessages.browse', compact('logmessages'))
               ->with(compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LogMessage  $logMessage
     * @return \Illuminate\Http\Response
     */
    public function show(LogMessage $logmessage)
    {
        $user = auth()->user();
        if ($user->canRead(Content::LogMessage)) {
            return view('logmessages.show', compact('logmessage'));
        }
        return redirect()->route('logmessages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LogMessage  $logMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogMessage $logmessage)
    {
        $user = auth()->user();
        if ($user->canDelete(Content::LogMessage)) {
            $logmessage->delete();
        } else if ($user->canDisable(Content::LogMessage)) {
            $logmessage->status = false;
            $logmessage->save();
        }
        return redirect()->route('logmessages.index');
    }
}
