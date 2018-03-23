<?php
/**
 * Created by PhpStorm.
 * User: anandia
 * Date: 3/9/18
 * Time: 8:43 AM
 */

namespace Modules\Loyalty\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    protected $fillable = [
        'user_id',
        'code',
    ];
}