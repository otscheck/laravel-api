<?php

namespace App\Http\Filters\V1;

use Illuminate\Http\Request;
use App\Http\Filters\ApiFilter;

class InvoiceFilter extends ApiFilter{

    protected $safeParams = [
        'customerId'=>['eq', 'gt', 'lt'],
        'amount'=>['eq', 'gt', 'lt'],
        'status'=>['eq', 'ne'],
        'billedDate'=>['eq', 'gt', 'lt'],
        'paidDate'=>['eq', 'gt', 'lt'],
    ];

    protected $columnMap = [
        'billedDate'=> 'billed_date',
        'paidDate'=> 'paid_date',
        'customerId'=> 'customer_id',
    ];

    protected $operatorMap=[
        'eq'=>'=',
        'gt'=>'>',
        'lt'=>'<',
        'lte'=>'<=',
        'gte'=>'>=',
        'ne'=>'!='
    ];
    
}