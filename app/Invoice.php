<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

	protected $table = 'invoices';

	protected $primaryKey = 'invoice_num';

	public $incrementing = false;
    
    protected $fillable = [
        'invoice_date', 'client_id', 'invoice_num',
    ];

    public $timestamps = false;

    protected $dates = [
        'invoice_date',
    ];

    public function client()
    {
    	return $this->belongsTo(Client::class, 'client_id', 'client_id');
    }

    public function invoiceLineItem()
    {
    	return $this->hasMany(InvoiceLineItem::class, 'invoice_num', 'invoice_num');
    }

    /**
    * function for  generate query according to the date
    * @param string $query
    * @param date $relative_date
    *
    * @return string query
    */
    public function scopeRelativeDate($query, $relative_date){
    	switch ($relative_date) {
    		case 'last_month':
    			$from = date('Y-m-01', strtotime('-1 MONTH'));
				$to = date('Y-m-d');
				return $query->whereBetween('invoice_date', [$from, $to]);
    			break;
			case 'this_month':
				return $query->whereYear('invoice_date', '=', date('Y'))
					->whereMonth('invoice_date', '=', date('m'));
				break;
			case 'this_year':
				return $query->whereYear('invoice_date', '=', date('Y'));
				break;
			case 'last_year':
				return $query->whereYear('invoice_date', '=', date("Y",strtotime("-1 year")));
				break;
    		default:
    			return $query->orderBy('invoices.invoice_date');
    			break;
    	}
    }

}
