<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

	protected $primaryKey = 'product_id';

	public $incrementing = false;
    
    protected $fillable = [
        'product_id', 'client_id', 'product_description'
    ];

    public $timestamps = false;

    public function client()
    {
    	return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function invoiceLineItem()
    {
    	return $this->hasMany(InvoiceLineItem::class, 'product_id', 'product_id');
    }
}
