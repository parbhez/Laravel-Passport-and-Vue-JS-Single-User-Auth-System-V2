<?php

namespace App\Http\Filters;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    protected $request;
    protected $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function filters()
    {
       // print_r($this->request->all());
        return $this->request->all();
    }

    public function apply(Builder $builder)
    {
        $this->builder = $builder;
        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
            // else{
            //     echo ucfirst($name) . " method not found" . "<br/>";
            //     throw new Exception(sprintf('The required method "%s" does not exist for %s', $name, get_class($this)));
            // }
        }

        return $this->builder;
    }


}
