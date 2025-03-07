<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class RankingController extends Controller
{
    public function index()
    {
        try {
            $companyId = auth()->user()->company_id;

            $company_users_rank = User::where('company_id', $companyId)
            ->where('role_id', 1)
            ->orderBy('points', 'desc')
            ->get();

            $users_rank = User::where('role_id', 1)
            ->orderBy('points', 'desc')
            ->limit(100)
            ->get();

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }

        return response()->json(['CompanyRanking' => $company_users_rank, 'GlobalRanking' => $users_rank], 200);
    }
}
