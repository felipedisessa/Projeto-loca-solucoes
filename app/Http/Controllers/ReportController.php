<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $users        = User::query()->get();
        $reservations = collect();

        if ($request->has(['start', 'end'])) {
            $start  = $request->input('start');
            $end    = $request->input('end');
            $userId = $request->input('user_id');

            $query = Reserve::whereBetween('start', [$start, $end])->withTrashed();

            if ($userId) {
                $query->where('user_id', $userId);
            }

            $reservations = $query->get();
        }

        return view('reports.index', compact('reservations', 'users'));
    }
}
