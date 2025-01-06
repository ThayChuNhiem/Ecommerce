<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class shop extends Model
{
    //
    use HasFactory;
    protected $table = 'shops'; 
    protected $fillable 
    = ['name', 'address', 'phone', 'email', 'description', 'image', 'status', 'owner'];

    public function owners() {
        return $this->belongsTo(User::class, 'owner');
    }
}
