<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Http\Requests\ItemRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Item::where('user_id', '=', Auth::user()->id)
            ->get();

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
        $item = auth()->user()->items()->create($data);
        session()->flash('success', 'Item successfuly added');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', ['item' => $item]);
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

        session()->flash('danger', 'Item has been deleted');
        return redirect()->route('items.my-items');
    }

    public function selled()
    {
        $items = Item::where('user_id', '=', Auth::user()->id)
            ->where('active', '=',  '0')
            ->get();

        return response()->json($items);
    }

    public function purchased()
    {
        $items = Item::where('buyer_id', '=', Auth::user()->id)->get();

        return view('items.purchased', ['items' => $items]);
    }
}