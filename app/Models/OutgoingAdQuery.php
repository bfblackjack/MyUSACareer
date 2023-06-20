<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingAdQuery extends Model
{
    protected $table = 'outgoing_ads_queries';
    protected $fillable = [
        'outgoing_ad_id', 'query'
    ];

}
