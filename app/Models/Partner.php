<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';
    protected $fillable = ['partner', 'weight', 'isTest'];

    public function ads() {
        return $this->hasMany(OutgoingAd::class, 'selected_partner_id');
    }
}
