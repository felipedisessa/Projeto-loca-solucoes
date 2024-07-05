<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Carbon\Carbon;
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

            $startDate = null;
            $endDate   = null;

            if (!is_null($start) && !is_null($end)) {
                $startDate = Carbon::createFromFormat('d/m/Y', $start);
                $endDate   = Carbon::createFromFormat('d/m/Y', $end);
            }

            if ($startDate && $endDate) {
                $query = Reserve::whereBetween('start', [$startDate, $endDate])
                    ->with([
                        'user' => function($query) {
                            $query->withTrashed();
                        },
                        'rentalItem' => function($query) {
                            $query->withTrashed();
                        },
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
        }

        return view('reports.index', compact('reservations', 'users', 'rental_items'));
    }
}
