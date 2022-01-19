<?php

namespace App\Actions\UserActions;

use App\Models\Item;
use Illuminate\Support\Carbon;

class GetUserProfileDataAction
{
  public function execute($user)
  {
    $selledItems = Item::where('user_id', '=', $user->id)
      ->where('active', '=', '0')
      ->where('buyer_id', '!=', null)
      ->get();

    $purchasedItems = Item::where('buyer_id', '=', $user->id)->get();

    $activeItems = Item::where('user_id', '=', $user->id)
      ->where('active', '=', '1')
      ->get();

    $bids = $user->bids;

    $selledThisMonth = Item::where('user_id', '=', $user->id)
      ->where('active', '=', '0')
      ->where('buyer_id', '!=', null)
      ->whereMonth('updated_at', Carbon::now()->month)
      ->get();


    $items = Item::where('user_id', '=', $user->id)->where('active', '=', '1')->get();


    $data = [
      'countPurchasedItems' => count($purchasedItems),
      'countSelledItems' => count($selledItems),
      'countActiveItems' => count($activeItems),
      'countBids' => count($bids),
      'sumSelledItems' => $selledItems->sum('bid_price'),
      'sumPurchasedItems' => $purchasedItems->sum('bid_price'),
      'sumMonthlyEarning' => $selledThisMonth->sum('bid_price'),
      'items' => $items
    ];

    return $data;
  }
}