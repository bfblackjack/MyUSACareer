<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutgoingAd extends Model
{
    protected $table = 'outgoing_ads';
    protected $fillable = ['selected_partner_id', 'pct_threshold', 'user_ip', 'user_agent', 'isTest', 'geo_city', 'geo_json'];
    protected $casts = [
        'geo_json' => 'json',
    ];

    public function partner() {
        return $this->belongsTo(Partner::class, 'selected_partner_id');
    }

    public function ad_query() {
        return $this->hasOne(OutgoingAdQuery::class, 'outgoing_ad_id');
    }
}
