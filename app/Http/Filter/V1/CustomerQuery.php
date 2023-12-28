<?php

namespace App\Http\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery{

    protected $safeParams = [
        'name'=>['eq'],
        'type'=>['eq'],
        'address'=>['eq'],
        'city'=>['eq'],
        'postalCode'=>['eq', 'gt', 'lt']
    ];

    protected $columnMap = [
        'postalCode'=> 'postal_code'
    ];

    protected $operatorMap=[
        'eq'=>'=',
        'gt'=>'>',
        'lt'=>'<',
    ];

    public function transform(Request $request) {     
        $finalQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);

            if(!isset($query)){
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if(isset($query[$operator])){
                    $finalQuery[]=[$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $finalQuery;
    }
}