<?php

namespace App\Actions\ItemActions;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class GetActiveItemsAction
{
  public function execute(Request $request)
  {

    $itemQuery = Item::query();
    $itemQuery->with('user');
    $search = $request->get('searchText');

    $itemQuery->where(function ($query) use ($search) {
      $query->where('name', 'like', '%' . $search . '%')
        ->orWhere('description', 'like', '%' . $search . '%')
        ->orwhereHas('user', function ($que) use ($search) {
          $que->where('first_name', 'like', '%' . $search . '%')
            ->orWhere('last_name', 'like', '%' . $search . '%');
        });
    });

    $itemQuery->where('active', 1);
    $items = $itemQuery->orderByDesc('created_at')->paginate(9);

    $categories = Category::orderBy('name')->get();

    return (['items' => $items, 'categories' => $categories, 'search' =>  $search]);
  }
}