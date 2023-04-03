<?php

namespace App\Http\Filters;

class RegisterSchoolFilter extends QueryFilter
{
    /**
     * Affiliate user search by name
     *
     * @param  String $str
     * @return Query Builder
     */
    public function school_name($str = '')
    {
        if (empty($str)) {
            return true;
        }
        return $this->builder->where('school_name', 'LIKE', '%'. $str . '%');
    }

    /**
     * Affiliate user search by email
     *
     * @param  String $str
     * @return Query Builder
     */
    public function user_name($str = '')
    {
        if (empty($str)) {
            return true;
        }
        return $this->builder->where('user_name', 'LIKE', '%'. $str . '%');
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
            ->when($str == 'school_name', function($q) {
                return $q->orderBy('school_name', request('direction') ?? 'asc');
            })
            ->when($str == 'user_name', function($q) {
                return $q->orderBy('user_name', request('direction') ?? 'asc');
            })
            ->when($str == 'db_name', function($q) {
                return $q->orderBy('db_name', request('direction') ?? 'asc');
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
            return $query->where('school_name', 'LIKE', '%'. $str . '%')
                ->orWhere('db_name', 'LIKE', '%'. $str .'%')
                ->orWhere('user_name',  'LIKE', '%'. $str . '%')
                ->orWhere('student_fees',  'LIKE', '%'. $str . '%');
        });

    }
}
