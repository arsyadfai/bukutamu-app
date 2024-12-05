<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'settings';

    // Define the fillable columns
    protected $fillable = [
        'app_name',
        'app_email',
        'theme_color',
    ];
}
