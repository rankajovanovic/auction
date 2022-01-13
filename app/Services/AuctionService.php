<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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
    $winner = $item->bids()->orderByDesc('price')->first();

    return $winner;
  }

  public function sellItemToTheWinner($item, $winner)
  {
    if ($winner !== null) {
      $item->buyer_id = $winner['user_id'];
      $item->bid_price = $winner['price'];
    }

    $item->active = 0;
    $item->save();
  }
}