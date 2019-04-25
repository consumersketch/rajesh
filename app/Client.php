<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

	protected $primaryKey = 'client_id';

	public $incrementing = false;
    
    protected $fillable = [
        'client_id', 'client_name',
    ];

    public $timestamps = false;
    /**
    * Defined the function for relation ship with Invoice
    *    
    * @return object
    */
    public function invoice()
    {
    	return $this->hasMany(Invoice::class, 'client_id', 'client_id');
    }

}
