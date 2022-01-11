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
      if ($this->checkIfTheAuctionTimeHasExpired($item->id)) {
        // Log::info($item->bids);
        $winner = $this->chooseTheWinnerOfAuction($item->id);
        $this->sellItemToTheWinner($item->id, $winner);
      }
    }

    // if (!$this->checkIfTheAuctionTimeHasExpired($id)) {
    //   return response()->json(->error' => 'Unable to complete auction.);
    // }
    // return response()->json(->message' => 'Auction completed successfully.);
  }

  public function checkIfTheAuctionTimeHasExpired($id)
  {

    $item = Item::findOrFail($id);
    $itemTime = $item->end_time;
    $timeNow = Carbon::now();

    return $timeNow->greaterThan($itemTime)  ? true : false;
  }

  public function chooseTheWinnerOfAuction($id)
  {
    $item = Item::with('bids')->findOrFail($id);
    $bids = $item->bids;
    $bids_length = count($bids);

    if ($bids_length == 0) {
      return null;
    }

    $start = 0;
    $winner = null;

    for ($i = 0; $i < $bids_length; $i++) {
      if ($start < $bids[$i]->price) {
        $start = $bids[$i]->price;
        $winner = $bids[$i];
      }
    }

    return $winner;
  }

  public function sellItemToTheWinner($id, $winner)
  {
    $item = Item::findOrFail($id);

    if ($winner == null) {
      $item->buyer_id = $item->user_id;
      $item->active = 0;
      $item->bid_price = 0;
      $item->save();
    }

    $item->buyer_id = $winner->user_id;
    $item->bid_price = $winner->price;
    $item->active = 0;
    $item->save();
  }
}