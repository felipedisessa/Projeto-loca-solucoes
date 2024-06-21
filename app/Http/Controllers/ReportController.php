<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $users        = User::query()->get();
        $rental_items = RentalItem::query()->get();
        $reservations = collect();

        if ($request->has(['start', 'end'])) {
            $start        = $request->input('start');
            $end          = $request->input('end');
            $status       = $request->input('status');
            $userId       = $request->input('user_id');
            $rentalItemId = $request->input('rental_item_id');

            $query = Reserve::whereBetween('start', [$start, $end]);

            if ($request->has('showDeleted')) {
                $query->withTrashed();
            }

            if ($status) {
                $query->where('status', $status);
            }

            if ($userId) {
                $query->where('user_id', $userId);
            }

            if ($rentalItemId) {
                $query->where('rental_item_id', $rentalItemId);
            }

            $reservations = $query->get();
        }

        return view('reports.index', compact('reservations', 'users', 'rental_items'));
    }
}
