<?php
namespace App\Http\Traits;

trait FillModelTrait {
	public function getFillables() {
	    return $this->fillable;
	}

    public function fill_model($model, $request) {
        $fields = $request->only($this->getFillables());
		$model->fill($fields);
		$model->save();
		return $model;
    }
}