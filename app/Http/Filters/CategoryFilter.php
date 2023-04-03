<?php

namespace App\Http\Filters;

class CategoryFilter extends QueryFilter
{
    /**
     * Category search by Category name
     *
     * @param  String $str
     * @return Query Builder
     */
    public function category_name($str = '')
    {
        if (empty($str)) {
            return true;
        }
        return $this->builder->where('category_name', 'LIKE', '%'. $str . '%');
    }

   
    /**
     * Affiliate user order by column and value
     *
     * @param  String  $str
     * @return Query Builder
     */
    public function order($str = null)
    {
        if (empty($str)) {
            return true;
        }
        return $this->builder
            ->when($str == 'category_name', function($q) {
                return $q->orderBy('category_name', request('direction') ?? 'asc');
            });
    }

    /**
     * Affiliate user search by random string
     *
     * @param  String $str
     * @return Query Builder
     */
    public function q($str = '')
    {
        if (empty($str)) {
            return true;
        }
        return $this->builder->where( function($query) use ($str) {
            return $query->where('category_name', 'LIKE', '%'. $str . '%');
        });

    }
}
