<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OldTempleTourController extends Controller
{
    public function index(Request $request)
    {
        // Fetch old puja requests with optional filters
        $filter = $request->input('filter');
        $search = $request->input('search');
        $status = $request->input('status');
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        $query = DB::table('tbl_temple_tours')
            ->select(
                'tbl_temple_tours.tour_id',
                'tbl_temple_tours.tour_request_id',
                'tbl_temple_tours.tour_date',
                'tbl_temple_tours.tour_time',
                'tbl_temple_tours.name',
                'tbl_temple_tours.email',
                'tbl_temple_tours.primary_phone',
                'tbl_temple_tours.alternate_tour_date',
                'tbl_temple_tours.alternate_tour_time',
                'tbl_temple_tours.total_visitor',
                'tbl_temple_tours.add_time',
                DB::raw('(SELECT tour_status FROM tbl_temple_tours_status WHERE tbl_temple_tours_status.tour_id = tbl_temple_tours.tour_id ORDER BY t_id DESC LIMIT 1) as request_status')
            );

        // Apply filters
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('tbl_temple_tours.tour_request_id', 'like', '%' . $search . '%')
                ->orWhere("tbl_temple_tours.name", 'like', '%' . $search . '%');
            });
        }

        if ($status) {
            $query->whereRaw('(SELECT tour_status FROM tbl_temple_tours_status WHERE tbl_temple_tours_status.tour_id = tbl_temple_tours.tour_id ORDER BY t_id DESC LIMIT 1) = ?', [$status]);
        }

        if ($from_date) {
            $query->where('tbl_temple_tours.tour_date', '>=', $from_date);
        }
        if ($to_date) {
            $query->where('tbl_temple_tours.tour_date', '<=', $to_date);
        }

        $orders = $query->orderBy('tbl_temple_tours.add_time', 'desc')->paginate(20);

        return view('old_templetours.index', compact('orders'));
    }
    public function show($id)
    {
        // Fetch specific old puja request details
        $order = DB::table('tbl_temple_tours')
            ->select(
                'tbl_temple_tours.tour_id',
                'tbl_temple_tours.tour_request_id',
                'tbl_temple_tours.tour_date',
                'tbl_temple_tours.tour_time',
                'tbl_temple_tours.name',
                'tbl_temple_tours.email',
                'tbl_temple_tours.primary_phone',
                'tbl_temple_tours.alternate_tour_date',
                'tbl_temple_tours.alternate_tour_time',
                'tbl_temple_tours.total_visitor',
                'tbl_temple_tours.age_range_of_group',
                'tbl_temple_tours.comment',
                DB::raw('(SELECT tour_status FROM tbl_temple_tours_status WHERE tbl_temple_tours_status.tour_id = tbl_temple_tours.tour_id ORDER BY t_id DESC LIMIT 1) as request_status')
            )
            ->where('tbl_temple_tours.tour_id', $id)
            ->first();

        if (!$order) {
            abort(404, 'Tour request not found');
        }

        return view('old_templetours.show', compact('order'));
    }
}
