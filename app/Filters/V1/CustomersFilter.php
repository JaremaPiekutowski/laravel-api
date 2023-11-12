<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class CustomersFilter extends ApiFilter {
    // transform the query parameters into an array
    protected $safeParams = [ // allowed query parameters
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt']
    ];

    protected $columnMap = [ // map the query parameter to the column name
        'postalCode' => 'postal_code'
    ];

    protected $operatorMap = [  // map the query parameter to the operator
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>=',
    ];
}
