<?php

use Illuminate\Http\Request;

class LearningDay25_22_03 extends TestCase
{
    /**
     * today i learnt about validating how to get optional fields in form request. 
     */
    public function validate_that_either_of_thefacebook_and_admob_is_required(Request $request)
    {
        $request->validate([
            'facebook' => ['boolean', 'required_without:admob'],
            'fbappid' => ['required_with:facebook', 'string', 'nullable', 'required_if:facebook,1'],
            'fbbannerid' => ['required_with:facebook', 'string', 'nullable', 'required_if:facebook,1'],
            'fbinterid' => ['required_with:facebook', 'string', 'nullable', 'required_if:facebook,1'],

            'admob' => ['boolean', 'required_without:facebook'],
            'adappid' => ['string', 'nullable', 'required_with:admob', 'required_if:admob,1'],
            'adbannerid' => ['required_with:admob', 'nullable', 'string', 'required_if:admob,1'],
            'adinterid' => ['required_with:admob', 'nullable', 'string', 'required_if:admob,1'],
        ]);
    }
}
