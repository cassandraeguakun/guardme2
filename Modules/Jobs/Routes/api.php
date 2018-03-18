<?php

Route::group(['prefix' => 'jobs', 'middleware' => 'auth:api'], function(){
    Route::post('new', 'JobsController@saveJob');
    Route::get('auth/active', 'JobsController@getAuthUserActiveJobs');

    Route::get('{user_id}/job-profile', 'JobsController@getUserJobProfile');

    Route::post('/{job_id}/auth/apply', 'JobsController@applyToJob');
    Route::get('/{job_id}/applicants', 'JobsController@getJobApplicants');

});
Route::get('/jobs/listings', 'JobsController@getJobListings');
