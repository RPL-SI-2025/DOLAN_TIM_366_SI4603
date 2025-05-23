<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $fillable = ['name', 'description', 'discount', 'user_id'];
    protected $table = 'badge';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
