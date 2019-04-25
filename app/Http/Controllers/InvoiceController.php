<?php

 /**
   * Invoice
   * 
   * 
   * @package    laravel
   * @subpackage Controller
   * @author

   */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
use App\Client;
use App\Product;
use App\InvoiceLineItem;

class InvoiceController extends Controller
{
	 /**
 * A index function to load default view
 * 
 * @return object 
 */
	public function index(Request $request)
	{
		$clients = Client::with('invoice')->get();
		return view('invoice.index', compact('clients'));		
	}
 /**
 * A search function 
 * 
 * 
 * @param integer $client_id 
 * @param integer $product_id 
 * @param date   $relative_date
 *
 * @return object  
 */
	public function search(Request $request)
	{
		$client_id = $request->get('client_id');
		$product_id = $request->get('product_id');
		$relative_date = $request->get('relative_date');
		
		$invoice_items = InvoiceLineItem::with(['invoice' => function ($q) use($client_id) {
				$q->with('client')->where('client_id',$client_id);
			}, 'product'])
			->whereHas('invoice', function ($query) use($relative_date) {
    			$query->relativeDate($relative_date);
			})
			->where('product_id', $product_id)->get();
		$return_array = [];

		foreach ($invoice_items as $invoice_item) {
			$return_array [] = [
				'invoice_num' => $invoice_item->invoice_num,
				'invoice_date' => $invoice_item->invoice->invoice_date->format('m-d-Y'),
				'client' => optional($invoice_item->invoice)->client->client_name,
				'product' => optional($invoice_item->product)->product_description,
				'qty' => $invoice_item->qty,
				'price' => $invoice_item->price,
				'total' => $invoice_item->price * $invoice_item->qty,
			];
		}
		unset($invoice_items);
		return $return_array;	
	}

	/* This method search product base on client id*/
	public function searchProduct(Request $request)
	{
		$client_id = $request->get('client_id');
		$products = Product::where('client_id', $client_id)->get();
		return $products;
	}
	
}
