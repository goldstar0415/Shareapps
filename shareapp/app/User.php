<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//Notification for Seller
use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\AdminResetPassword as ResetAdminPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'company_name', 'email', 'phone_number', 'password', 'country_code', 'country_name', 'phone_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendAdminPasswordResetNotification($token)
    {
        // Your your own implementation.
        $this->notify(new ResetAdminPasswordNotification($token));
    }
}
