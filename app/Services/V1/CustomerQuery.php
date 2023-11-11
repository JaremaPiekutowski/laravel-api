<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery {
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

    public function transform(Request $request) {
        // transform the query parameters into an array
        $eloQuery = [];

        foreach ($this->safeParams as $param => $operators) {
            $query = $request->query($param);  // get the query parameter

            if (!isset($query)) {  // if the query parameter is not set, continue
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;  // get the column name

            foreach ($operators as $operator)  {  // get the operator
                if (isset($query[$operator])) {  // if the operator is set, add to the eloquent query
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];  // add to the eloquent query
                }
            }
        }

        return $eloQuery;
    }
}
