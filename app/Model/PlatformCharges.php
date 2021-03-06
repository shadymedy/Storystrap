<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PlatformCharges extends Model
{

    protected $fillable = [
        'amount', 'charges', 'document_id', 'purpose_of_use', 'payment_type'
    ];

    public function document()
    {
        return $this->belongsTo('App\Model\Document', 'document_id', 'document_id')->with('payment');
    }

    public function amountPaid()
    {
        return $this->belongsTo('App\Model\Payment', 'document_id', 'document_id');
    }
}
