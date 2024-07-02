<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $this->authorize('admin-or-landlord');

        $users        = User::withTrashed()->get();
        $rental_items = RentalItem::withTrashed()->get();
        $reservations = collect();

        if ($request->has(['start', 'end'])) {
            $start        = $request->input('start');
            $end          = $request->input('end');
            $status       = $request->input('status');
            $userId       = $request->input('user_id');
            $rentalItemId = $request->input('rental_item_id');

            $query = Reserve::whereBetween('start', [$start, $end])
                ->with([
                    'user' => function($query) {
                        $query->withTrashed();
                    }, 'rentalItem' => function($query) {
                        $query->withTrashed();
                    }
                ]);

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
