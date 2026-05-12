<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Quotation extends Model
{
    //
    use notifiable, hasfactory;

    protected $fillable = [
        'user_id',
        'subject',
        'description',
        'attachment',
        'admin_message',
        'status',
        'quotation_price',
        'contact_name', 
        'company_name',
        'email', 'phone', 'material', 'quantity', 'required_date',
        'reference', 'token',
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }

}
