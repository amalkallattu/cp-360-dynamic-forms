<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmissionsData extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * element
     *
     * @return void
     */
    public function element()
    {
        return $this->belongsTo(FormElement::class, 'form_element_id');
    }
}
