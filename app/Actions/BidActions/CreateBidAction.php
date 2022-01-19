<?php

namespace App\Actions\BidActions;

use App\Models\Item;
use App\Models\Bid;


class CreateBidAction
{
  public function execute(Item $item,  $data)
  {
    if ($this->isUserAlreadyHaveBid($item)) {
      \Toastr::error('You are already place bid for this item', null, ["positionClass" => "toast-top-right"]);

      return;
    }

    if (auth()->user()->id === $item->user_id) {
      \Toastr::error('You cannot set a bid for your item', null, ["positionClass" => "toast-top-right"]);

      return;
    }

    if ($this->isBidHigherThanThePrice($item, $data)) {

      $data['item_id'] = $item->id;
      $data['user_id'] = auth()->user()->id;
      Bid::create($data);

      \Toastr::success('Successfully added bid', null, ["positionClass" => "toast-top-right"]);
      return;
    }

    \Toastr::error('Your bid must be higher than the current price', null, ["positionClass" => "toast-top-right"]);
    return;
  }

  public function isBidHigherThanThePrice($item, $data): bool
  {
    $item->bids ? $minPrice = $item->bids->max('price') : $minPrice = $item->price;

    if ($minPrice > $data['price']) {
      return false;
    }

    return true;
  }

  public function isUserAlreadyHaveBid($item): bool
  {
    $check = Bid::where('user_id', '=', auth()->user()->id)->where('item_id', '=', $item->id)->get();
    return ($check->isNotEmpty());
  }
}