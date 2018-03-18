<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 25/01/2018
 * Time: 04:34 PM
 */

namespace Modules\Jobs\Events;


use Modules\Jobs\Models\Job;
use Modules\Loyalty\Models\Referral;
use Modules\Loyalty\Models\ReferralCredit;

class JobWasBidded
{
    /**
     * @var Job
     */
    public $job;

    public $user_id;
    public $bidAmount;


    /**
     * JobWasCreated constructor.
     * @param Job $job
     * @param $user_id
     * @param $bidAmount
     */
    public function __construct(Job $job, $user_id, $bidAmount)
    {
        $this->job = $job;
        $this->user_id = $user_id;
        $this->bidAmount = $bidAmount;

        $this->insertReferralCredit();
    }

    private function insertReferralCredit()
    {
        $referrer_id = auth()->user()->referrer_id;
        if($referrer_id){
            ReferralCredit::create([
                'job_id' => $this->job->id,
                'user_id' => $this->user_id,
                'referral_id' => $referrer_id,
                'credit' => 10
            ]);
        }
    }
}