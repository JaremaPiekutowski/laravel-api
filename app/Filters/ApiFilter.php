<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {
    // transform the query parameters into an array
    protected $safeParams = [];

    protected $columnMap = [];

    protected $operatorMap = [];

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
