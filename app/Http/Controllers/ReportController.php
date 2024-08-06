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

        if ($request->has('filter')) {
            $filter = $request->input('filter');
            $query  = Reserve::with([
                'user' => function($query) {
                    $query->withTrashed();
                },
                'rentalItem' => function($query) {
                    $query->withTrashed();
                },
            ]);

            if ($filter === 'today') {
                $startDate = Carbon::today();
                $endDate   = Carbon::today()->endOfDay();
            } elseif ($filter === 'week') {
                $startDate = Carbon::now()->startOfWeek();
                $endDate   = Carbon::now()->endOfWeek();
            } elseif ($filter === 'month') {
                $startDate = Carbon::now()->startOfMonth();
                $endDate   = Carbon::now()->endOfMonth();
            }

            $query->whereBetween('start', [$startDate, $endDate]);

            if ($request->has('showDeleted')) {
                $query->withTrashed();
            }

            $reservations = $query->get();
        } elseif ($request->has(['start', 'end'])) {
            $start         = $request->input('start');
            $end           = $request->input('end');
            $status        = $request->input('status');
            $userId        = $request->input('user_id');
            $rentalItemId  = $request->input('rental_item_id');
            $paymentStatus = $request->input('payment_status');
            $paymentType   = $request->input('payment_type');

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

                if ($paymentStatus) {
                    if ($paymentStatus === 'paid') {
                        $query->whereNotNull('paid_at');
                    } else {
                        if ($paymentStatus === 'unpaid') {
                            $query->whereNull('paid_at');
                        }
                    }
                }

                if ($paymentType) {
                    $query->where('payment_type', $paymentType);
                }

                $reservations = $query->get();
            }
        }

        return view('reports.index', compact('reservations', 'users', 'rental_items'));
    }
}
