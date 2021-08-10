<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'timezone_id',
        'date_format_id',
        'datetime_format_id',
        'currency_id',
        'name',
        'last_ip',
        'last_login_date',
        'address1',
        'address2',
        'city',
        'state',
        'postal_code',
        'country_id',
        'email_footer',
        'is_active',
        'is_banned',
        'is_beta',
        'stripe_access_token',
        'stripe_refresh_token',
        'stripe_secret_key',
        'stripe_publishable_key',
        'stripe_data_raw'
    ];
}
