<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OldHallController extends Controller
{
    public function index(Request $request)
    {
        // Fetch old puja requests with optional filters
        $filter = $request->input('filter');
        $search = $request->input('search');
        $status = $request->input('status');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $query = DB::table('tbl_order_hall_booking')
            ->select(
                'tbl_order_hall_booking.order_id',
                'tbl_order_hall_booking.hall_request_id',
                'tbl_order_hall_booking.payment_status',
                'tbl_order_hall_booking.order_date',
                'tbl_order_hall_booking.date_of_event',
                'tbl_order_hall_booking.start_time',
                'tbl_order_hall_booking.first_name',
                'tbl_order_hall_booking.last_name',
                'tbl_order_hall_booking.email',
                'tbl_order_hall_booking.primary_phone',
                'tbl_order_hall_booking.hours_duration',
                DB::raw('(SELECT package_name FROM tbl_order_hall_booking_item WHERE tbl_order_hall_booking_item.order_id = tbl_order_hall_booking.order_id ORDER BY id ASC LIMIT 1) as package_name'),
                DB::raw('(SELECT package_type_name FROM tbl_order_hall_booking_item WHERE tbl_order_hall_booking_item.order_id = tbl_order_hall_booking.order_id ORDER BY id ASC LIMIT 1) as package_type_name'),
                DB::raw('(SELECT main_status FROM tbl_order_hall_booking_status WHERE tbl_order_hall_booking_status.order_id = tbl_order_hall_booking.order_id ORDER BY h_id DESC LIMIT 1) as request_status')
            );

        // Apply filters
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('tbl_order_hall_booking.hall_request_id', 'like', '%' . $search . '%')
                ->orWhere(DB::raw("CONCAT(tbl_order_hall_booking.first_name, ' ', tbl_order_hall_booking.last_name)"), 'like', '%' . $search . '%');
            });
        }
        
        if ($status) {
            $query->whereRaw('(SELECT main_status FROM tbl_order_hall_booking_status WHERE tbl_order_hall_booking_status.order_id = tbl_order_hall_booking.order_id ORDER BY h_id DESC LIMIT 1) = ?', [$status]);
        }

        if ($from_date) {
            $query->where('tbl_order_hall_booking.date_of_event', '>=', $from_date);
        }
        if ($to_date) {
            $query->where('tbl_order_hall_booking.date_of_event', '<=', $to_date);
        }

        $orders = $query->orderBy('tbl_order_hall_booking.add_time', 'desc')->paginate(20);

        return view('old_hallrequests.index', compact('orders'));
    }

    public function show($id)
    {
        // Fetch specific old puja request details
        $order = DB::table('tbl_order_hall_booking')
            ->select(
                'tbl_order_hall_booking.order_id',
                'tbl_order_hall_booking.hall_request_id',
                'tbl_order_hall_booking.payment_status',
                'tbl_order_hall_booking.order_date',
                'tbl_order_hall_booking.date_of_event',
                'tbl_order_hall_booking.alternate_date_of_event',
                'tbl_order_hall_booking.start_time',
                'tbl_order_hall_booking.first_name',
                'tbl_order_hall_booking.last_name',
                'tbl_order_hall_booking.email',
                'tbl_order_hall_booking.primary_phone',
                'tbl_order_hall_booking.hours_duration',
                'tbl_order_hall_booking.comment',
                'tbl_order_hall_booking.total_amount',
                DB::raw('(SELECT package_name FROM tbl_order_hall_booking_item WHERE tbl_order_hall_booking_item.order_id = tbl_order_hall_booking.order_id ORDER BY id ASC LIMIT 1) as package_name'),
                DB::raw('(SELECT package_type_name FROM tbl_order_hall_booking_item WHERE tbl_order_hall_booking_item.order_id = tbl_order_hall_booking.order_id ORDER BY id ASC LIMIT 1) as package_type_name'),
                DB::raw('(SELECT main_status FROM tbl_order_hall_booking_status WHERE tbl_order_hall_booking_status.hall_request_id = tbl_order_hall_booking.hall_request_id ORDER BY h_id DESC LIMIT 1) as request_status')
            )
            ->where('tbl_order_hall_booking.order_id', $id)
            ->first();

        if (!$order) {
            abort(404, 'Puja request not found');
        }

        return view('old_hallrequests.show', compact('order'));
    }
}
