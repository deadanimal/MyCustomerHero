<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    public function create_prospect(Request $request) {

        $user = $request->user();
        $profile = $user->profile;
        $profile_type = $profile->type; 

        $prospect = Prospect::create([
            'tenant_id' => $request->tenant_id
        ]);

        return back();
        
    }

    public function list_prospects(Request $request) {}

    public function detail_prospect(Request $request) {}

    public function update_prospect(Request $request) {}

    public function upgrade_prospect_to_customer(Request $request) {}
}
