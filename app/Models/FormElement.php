<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormElement extends Model
{

    use HasFactory;

    protected $guarded = [];

    /**
     * inputType
     *
     * @return void
     */
    public function inputType()
    {
        return $this->belongsTo(InputType::class);
    }

    /**
     * options
     *
     * @return void
     */
    public function options()
    {
        return $this->hasMany(FormElementOption::class);
    }
}
