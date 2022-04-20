<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * submittedData
     *
     * @return void
     */
    public function submittedData()
    {
        return $this->hasMany(FormSubmissionsData::class);
    }
}
