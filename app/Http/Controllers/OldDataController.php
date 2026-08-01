<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OldDataController extends Controller
{
    public function index(Request $request)
    {
        // Fetch old puja requests with optional filters
        $filter = $request->input('filter');
        $search = $request->input('search');
        $status = $request->input('status');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $query = DB::table('tbl_order')
            ->select(
                'tbl_order.order_id',
                'tbl_order.puja_request_id',
                'tbl_order.payment_status',
                'tbl_order.order_date',
                'tbl_order.date_of_puja',
                'tbl_order.from_time_of_puja',
                'tbl_order.to_time_of_puja',
                'tbl_order.first_name',
                'tbl_order.last_name',
                'tbl_order.email',
                'tbl_order.contact_no',
                'tbl_order.add_time',
                DB::raw('(SELECT main_status FROM tbl_order_status WHERE tbl_order_status.order_id = tbl_order.order_id ORDER BY s_id DESC LIMIT 1) as request_status')
            );

        // Apply filters
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('tbl_order.puja_request_id', 'like', '%' . $search . '%')
                ->orWhere(DB::raw("CONCAT(tbl_order.first_name, ' ', tbl_order.last_name)"), 'like', '%' . $search . '%');
            });
        }

        if ($status) {
            $query->whereRaw('(SELECT main_status FROM tbl_order_status WHERE tbl_order_status.order_id = tbl_order.order_id ORDER BY s_id DESC LIMIT 1) = ?', [$status]);
        }

        if ($from_date) {
            $query->where('tbl_order.date_of_puja', '>=', $from_date);
        }
        if ($to_date) {
            $query->where('tbl_order.date_of_puja', '<=', $to_date);
        }

        $orders = $query->orderBy('tbl_order.add_time', 'desc')->paginate(20);

        // Fetch all puja_names for the paginated orders
        $orderIds = $orders->pluck('order_id')->toArray();
        $pujaNames = DB::table('tbl_order_puja')
            ->select('order_id', 'puja_name')
            ->whereIn('order_id', $orderIds)
            ->orderBy('id', 'desc')
            ->get()
            ->groupBy('order_id')
            ->map(function ($group) {
                return $group->pluck('puja_name')->unique()->implode(', ');
            });

        // Attach puja_names to orders
        $orders->getCollection()->transform(function ($order) use ($pujaNames) {
            $order->puja_names = $pujaNames[$order->order_id] ?? 'N/A';
            return $order;
        });

        return view('old-puja-requests.index', compact('orders'));
    }

    public function show($id)
    {
        // Fetch specific old puja request details
        $order = DB::table('tbl_order')
            ->select(
                'tbl_order.order_id',
                'tbl_order.puja_request_id',
                'tbl_order.payment_status',
                'tbl_order.order_date',
                'tbl_order.date_of_puja',
                'tbl_order.from_time_of_puja',
                'tbl_order.to_time_of_puja',
                'tbl_order.first_name',
                'tbl_order.last_name',
                'tbl_order.address',
                'tbl_order.city',
                'tbl_order.state_name',
                'tbl_order.pincode',
                'tbl_order.country_name',
                'tbl_order.name_of_requestor',
                'tbl_order.contact_no',
                'tbl_order.email',
                'tbl_order.alternate_date_of_puja_1',
                'tbl_order.alternate_date_of_puja_2',
                'tbl_order.total_amount',
                'tbl_order.add_time',
                'tbl_order.comment',
                DB::raw('(SELECT main_status FROM tbl_order_status WHERE tbl_order_status.order_id = tbl_order.order_id ORDER BY s_id DESC LIMIT 1) as request_status')
            )
            ->where('tbl_order.order_id', $id)
            ->first();

        if (!$order) {
            abort(404, 'Puja request not found');
        }

        $pujas = DB::table('tbl_order_puja')
            ->select('puja_name', 'amount')
            ->where('order_id', $id)
            ->orderBy('id', 'asc')
            ->get();

        return view('old-puja-requests.show', compact('order', 'pujas'));
    }
}