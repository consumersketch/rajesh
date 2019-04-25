<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceLineItem extends Model
{
    protected $table = 'invoicelineitems';

	protected $primaryKey = false;

	public $incrementing = false;
    
    protected $fillable = [
        'invoice_num', 'product_id', 'qty', 'price'
    ];

    public $timestamps = false;
    //define the relation ship with invoice
    public function invoice()
    {
    	return $this->belongsTo(Invoice::class, 'invoice_num', 'invoice_num');
    }
        //define the relation ship with invoice

    public function product()
    {
    	return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
