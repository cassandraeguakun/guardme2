<?php
/**
 * Created by PhpStorm.
 * User: Dennis
 * Date: 25/01/2018
 * Time: 04:34 PM
 */

namespace Modules\Jobs\Events;


use Modules\Jobs\Models\Job;

class UserWasHiredOnJob
{
    /**
     * @var Job
     */
    public $job;

    public $user_id;


    /**
     * JobWasCreated constructor.
     * @param Job $job
     * @param $user_id
     */
    public function __construct(Job $job, $user_id)
    {
        $this->job = $job;
        $this->user_id = $user_id;
    }
}