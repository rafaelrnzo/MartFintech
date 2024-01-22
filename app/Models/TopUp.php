<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUp extends Model
{
    use HasFactory;

    
    protected $fillable = [
        "nominals",
        "order_id",
        "status",
        "user_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
