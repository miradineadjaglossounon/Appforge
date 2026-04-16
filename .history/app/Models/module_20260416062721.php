<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'descr'


    ]



    public function users()
    {
        return $this->belongsToMany(User::class, 'UserModule');
    }


}
