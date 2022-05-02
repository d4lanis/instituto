<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Schema;
use Config;

class GetListItems {
    public static function get_lists_items($list_name){
        $values = Config::get($list_name);
    	$data = [];
    	foreach ($values as $value) {
    		$data[] = [
    			'id' => $value,
    			'name' => $value
    		];
    	}

    	return $data;
    }

    public static function print_model($model)
    {
        //$columns = Schema::getColumnListing($model->getTable());
        $columns = $model->attributesToArray();
        return $columns;
    }
}    