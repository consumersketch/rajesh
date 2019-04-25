@extends('layouts.app')
@section('content')
	<div class="jumbotron text-center">
	  <h1>Search Invoice</h1>
	</div>
    <div class="row">
	    <div class="col-sm-12">
			<form action="{{ route('invoice.search') }}" class="needs-validation" id="search_form">
				<div class="form-group">
					<label for="client_id">Client:</label>
					<select id="client_id" name="client_id" class="form-control">
						@foreach($clients as $client)
							<option value="{{ $client->client_id }}">{{ $client->client_name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="product_id">Product:</label>
					<select id="product_id" name="product_id" class="form-control">
						{{-- <option></option> --}}
					</select>
				</div>
				<div class="form-group">
					<label for="relative_date">Relative Date:</label>
					<select id="relative_date" name="relative_date" class="form-control">
						<option value="">-</option>
						<option value="last_month">Last Month to Date</option>
						<option value="this_month">This Month</option>
						<option value="this_year">This Year</option>
						<option value="last_year">Last Year</option>
					</select>
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-danger">Reset</button>
				</div>
			</form>
	    </div>
	    <div class="col-sm-12">
	    	<h2>Invoice Data</h2>	
	    	<table class="table" id='invoice_table'>
	    		<thead>
	    			<tr>
	    				<th>Invoice Num</th>
	    				<th>Invoice Date</th>
	    				<th>Product</th>
	    				<th>Qty</th>
	    				<th>Price</th>
	    				<th>Total</th>
	    			</tr>
	    		</thead>
	    		<tbody>
	    			<tr><td colspan="6" align="center">No data.</td></tr>
	    		</tbody>
	    		<tfoot>
	    			<tr>
	    				<th>Invoice Num</th>
	    				<th>Invoice Date</th>
	    				<th>Product</th>
	    				<th>Qty</th>
	    				<th>Price</th>
	    				<th>Total</th>
	    			</tr>
	    		</tfoot>
	    	</table>
	    </div>

  </div>
@endsection