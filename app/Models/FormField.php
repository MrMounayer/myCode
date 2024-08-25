<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    // to be filled with allowed colums to fill
    // protected $fillable = []; 

    protected $casts = [
        "options"=> "json",
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    // guarded fields not to send back when a user makes a request
    protected $guarded = ['id'];
}
