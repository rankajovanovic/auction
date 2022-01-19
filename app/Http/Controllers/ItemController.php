<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;
use App\Http\Requests\ItemRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Bid;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Item::where('user_id', '=', Auth::user()->id)->where('active', '=', '1')->get();

        return view('items.my-items', ['items' => $items]);
    }

    /**
     * 
     *  Show  view for create item.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $this->authorize('create', Item::class);
        $data = $request->validated();
        $data['end_time'] = Carbon::now()->addDays(10);
        auth()->user()->items()->create($data);
        \Toastr::success('Item has been deleted', null, ["positionClass" => "toast-top-right"]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $item = Item::findBySlugOrFail($slug);
        $categories = Category::orderBy('name')->get();
        $userBid = '';
        if (auth()->user()) {
            $userBid = Bid::where('item_id', '=', $item->id)
                ->where('user_id', '=', auth()->user()->id)->first();
        }

        return view('items.show', ['item' => $item, 'categories' => $categories, 'userBid' => $userBid]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $this->authorize('delete', $item);
        $item->delete();
        \Toastr::error('Item has been deleted', null, ["positionClass" => "toast-top-right"]);

        return redirect()->route('items.my-items');
    }

    public function selled()
    {
        $items = Item::where('user_id', '=', Auth::user()->id)
            ->where('active', '=',  '0')
            ->get();

        return view('items.selled', ['items' => $items]);
    }

    public function purchased()
    {
        $items = Item::where('buyer_id', '=', Auth::user()->id)->get();

        return view('items.purchased', ['items' => $items]);
    }
}