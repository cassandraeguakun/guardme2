<?php
/**
 * Created by PhpStorm.
 * User: anandia
 * Date: 3/9/18
 * Time: 8:41 AM
 */

namespace Modules\Loyalty\Repositories;

use Illuminate\Http\Request;
use Modules\Loyalty\Models\Referral;
use Modules\Loyalty\Models\ReferralCredit;
use Modules\Users\Models\User;

class LoyaltyRepository
{
    const COUNT_IN_ONE_PAGE = 10;

    protected function getUserId(){
        return auth()->user()->id;
    }

    public function all($filter = '')
    {
        $user_id = $this->getUserId();
        $user = User::with(['loyalties'])->where('referrer_id', $user_id);

        if($filter == 'newest'){
            $user->orderBy('registered_date', 'desc');
        }elseif ($filter == 'oldest'){
            $user->orderBy('registered_date', 'asc');
        }

        return $user->paginate(static::COUNT_IN_ONE_PAGE);
    }

    public function getExpiredList()
    {
        $user_id = $this->getUserId();
        $days_ago = date("Y-m-d", strtotime("-30 day"));
        return Referral::where('user_id', $user_id)
                         ->where('updated_at', '<', $days_ago)
                         ->paginate(static::COUNT_IN_ONE_PAGE);
    }

    public function getRedeemCredit($is_redeemed = 0, $filter = null)
    {
        $return = ReferralCredit::with(['job', 'user'])
                    ->where('is_redeemed', $is_redeemed)
                    ->where('referral_id', auth()->user()->id);

        if($filter == 'newest'){
            $return->orderBy('date_redeemed', 'desc');
        }elseif ($filter == 'oldest'){
            $return->orderBy('date_redeemed', 'asc');
        }

        return $return->paginate(static::COUNT_IN_ONE_PAGE);
    }

    public function getTotalRedeemedCredit()
    {
        $return = ReferralCredit::where('is_redeemed', 0)
            ->where('referral_id', auth()->user()->id)
            ->sum('credit');

        return $return;
    }

    public function getRedeemCreditById($id)
    {
        $user_id = auth()->user()->id;
        $return = ReferralCredit::where('id', $id)->where('referral_id', $user_id)->first()->toArray();
        $return['total_credit'] = ReferralCredit::where('referral_id', $user_id)->sum('credit');
        return $return;
    }

    public function storeRedeemCredit($store)
    {
        $data = [
          'is_redeemed' => 1,
          'date_redeemed' => now(),
        ];
        $result = array_merge($store, $data);
        return ReferralCredit::where('id', $store['id'])->update($result);
    }
}