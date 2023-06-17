<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Relationship to user
use App\Model\Category;

class Ticket extends Model
{
    use HasFactory;
    
    // Assign mass assignment to the ticket fields
    protected $fillable = [
        'user_id', 'category_id', 'ticket_id', 'title', 'priority', 'message', 'status',
    ];
    
    // This will show who the ticket was logged by  
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function details(): BelongsTo
    {
        return $this->belongsTo(Personal::class);
    }
}
