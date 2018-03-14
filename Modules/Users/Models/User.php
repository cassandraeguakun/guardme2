<?php

namespace Modules\Users\Models;

use Illuminate\Notifications\Notifiable;
use Modules\Account\Traits\UserAccountTrait;
use Modules\Company\Traits\CompanyUserTrait;
use Modules\Jobs\Traits\JobbableUserTrait;
use Modules\Loyalty\Traits\LoyaltyUserTrait;


class User extends \Illuminate\Foundation\Auth\User
{
    use Notifiable,
        UserAccountTrait,
        JobbableUserTrait,
        CompanyUserTrait,
        LoyaltyUserTrait;

    protected $table = 'users';

    protected $guarded = ['id'];

    protected $dates = [
        'registered_date'
    ];

    protected $casts = [
        'active' => 'boolean'
    ];

    /**
     * @return $this
     */
    public function setApiToken()
    {
        $this->api_token = str_random(60);

        return $this;
    }

    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function getMetadataAttribute($value){
        if($value){
            return json_decode($value, true);
        } else {
            return [];
        }
    }

    public function setPassword($password)
    {
        return $this->update(['password' => bcrypt($password)]);
    }


}
