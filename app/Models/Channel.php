<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;
	protected $primaryKey = "channel_no";
	protected $fillable = ['channel_name', 'epg_date','program_id', 'epg_start_time','epg_end_time'];
}
