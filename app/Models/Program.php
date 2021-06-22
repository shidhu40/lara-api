<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
	protected $primaryKey = "program_id";
	protected $fillable = ['program_title', 'program_age_rating','program_description', 'program_type'];
}
