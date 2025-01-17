<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $fillable = ["country"];

    protected $guarded = ['id'];

    public function form_fields()
    {
        return $this->hasMany(FormField::class,"form_id","id");
    }
}
