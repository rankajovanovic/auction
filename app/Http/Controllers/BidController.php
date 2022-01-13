<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Http\Requests\BidRequest;
use App\Models\Item;
use App\Actions\BidActions\CreateBidAction;

class BidController extends Controller
{

    private CreateBidAction $createBidAction;

    public function __construct(CreateBidAction $createBidAction)
    {
        $this->createBidAction = $createBidAction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bids = Bid::with('item')->whereHas('item', function ($query) {
            $query->where('active', '=', '1');
        })->orderByDesc('created_at')->get();

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
        $this->createBidAction->execute($item, $data);

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
        // $bids = auth()->user()->bids;
        $bids = Bid::with('item')->whereHas('item', function ($query) {
            $query->where('active', '=', '1');
        })->where('user_id', '=', auth()->user()->id)
            ->orderByDesc('created_at')->get();

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
        \Toastr::error('Bid has been deleted', null, ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
}