<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class InvoicesFilter extends ApiFilter {
    // transform the query parameters into an array
    protected $safeParams = [ // allowed query parameters
        'customer_id' => ['eq'],
        'amount' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'status' => ['eq', 'ne'],
        'billed_date' => ['eq', 'gt', 'lt', 'lte', 'gte'],
        'paid_data' => ['eq', 'gt', 'lt'],
    ];

    protected $columnMap = [ // map the query parameter to the column name
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
    ];

    protected $operatorMap = [  // map the query parameter to the operator
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!=',
    ];
}
