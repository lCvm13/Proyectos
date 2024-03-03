<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Event extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    protected $fillable = [
        'title', 'start', 'end','user_id'
    ];
}