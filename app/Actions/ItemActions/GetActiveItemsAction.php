<?php

namespace App\Actions\ItemActions;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class GetActiveItemsAction
{
  public function execute(Request $request, $slug = null)
  {

    $itemQuery = Item::query();
    $itemQuery->with('user', 'bids');

    if ($request->get('searchText')) {
      $search = $request->get('searchText');

      $itemQuery->where(function ($query) use ($search) {
        $query->where('name', 'like', '%' . $search . '%')
          ->orWhere('description', 'like', '%' . $search . '%')
          ->orwhereHas('user', function ($que) use ($search) {
            $que->where('first_name', 'like', '%' . $search . '%')
              ->orWhere('last_name', 'like', '%' . $search . '%')
              ->orWhere('username', 'like', '%' . $search . '%');
          });
      });
    }

    if ($slug !== null) {
      $category = Category::findBySlugOrFail($slug);
      $itemQuery->where('category_id', $category->id);
    }

    $itemQuery->where('active', 1);
    $items = $itemQuery->orderByDesc('created_at')->paginate(9);

    $popularItems = Item::with('bids')
      ->has('bids')
      ->where('active', 1)
      ->withCount('bids')
      ->orderBy('bids_count', 'desc')
      ->limit(9)
      ->get();

    $mostExpensiveItems = Item::with('bids')
      ->where('active', 1)
      ->leftJoin('bids', 'items.id', '=', 'bids.item_id')
      ->select(['items.*', \DB::raw('IF(bids.id IS NOT NULL, max(bids.price), items.price) as max_bid')])
      ->groupBy('items.id')
      ->orderBy('max_bid', 'desc')
      ->limit(9)
      ->get();

    $categories = Category::orderBy('name')->get();

    return (['items' => $items, 'categories' => $categories, 'popularItems' => $popularItems, 'mostExpensiveItems' => $mostExpensiveItems]);
  }
}