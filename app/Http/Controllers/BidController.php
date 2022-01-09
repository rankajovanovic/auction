<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Http\Requests\BidRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Redirect;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bids = Bid::all();
        return view('admin.bids', compact('bids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BidRequest $request, Item $item)
    {
        $data = $request->validated();

        $minPrice = $item['price'];
        $userId =  auth()->user()->id;

        if ($minPrice >= $data['price']) {
            session()->flash('danger', 'Your bid must be greater than the item price');
            return redirect()->back();
        }

        $check = Bid::where('user_id', '=', $userId)->where('item_id', '=', $item->id)->get();
        if (!$check->isEmpty()) {
            session()->flash('danger', 'You are already place bid for this item');
            return redirect()->back();
        }

        $data['item_id'] = $item->id;
        $data['user_id'] = $userId;
        Bid::create($data);

        $item->price = $data['price'];
        $item->save();

        session()->flash('success', 'Successfully added bid');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $bids = auth()->user()->bids;

        return view('items.my-bids', compact('bids'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $bid)
    {
        $this->authorize('delete', $bid);
        $bid->delete();

        session()->flash('danger', 'Bid has been deleted');
        return redirect()->back();
    }
}