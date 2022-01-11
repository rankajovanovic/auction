<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Carbon;

class AuctionService
{

  public function handleItemAuction()
  {
    $items = Item::with('bids')->get();

    foreach ($items as $item) {
      if ($this->checkIfTheAuctionTimeHasExpired($item)) {
        $winnerBid = $this->chooseTheWinnerOfAuction($item);
        $this->sellItemToTheWinner($item, $winnerBid);
      }
    }
  }

  public function checkIfTheAuctionTimeHasExpired($item)
  {
    $timeNow = Carbon::now();

    return $timeNow->greaterThan($item->end_time)  ? true : false;
  }

  public function chooseTheWinnerOfAuction($item)
  {
    $item->bids->max('price')->isEmpty() ?  $winner = null :   $winner = $item->bids->max('price');
    return $winner;
  }

  public function sellItemToTheWinner($item, $winner)
  {
    if ($winner) {
      $item->buyer_id = $winner->user_id;
      $item->bid_price = $winner->price;
    }

    $item->active = 0;
    $item->save();
  }
}