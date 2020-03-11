<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

	public function getOrderPrice()
	{
		return $this->orderProducts->sum(function($t) { 
            return (int) $t->price * $t->quantity;
        });
	}

    public function getOrderContents()
    {
        $product_names = [];

        foreach ($this->orderProducts as $orderProduct) {
            $product_names[] = $orderProduct->product->name;
        }
        
        return join(', ', $product_names);
    }
}
