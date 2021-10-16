<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentingCycle;
use App\Models\Cycle;
use App\Models\User;
use Carbon\Carbon;
use PdfReport;
use Gate;

class ReportsController extends Controller
{
    public function selectParams()
    {
        return view('admin.reports.selectParams');
    }
    public function dueCycles(Request $request)
    {
        //dd($request->all());
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = 'to_date';
    
        $title = 'Revolution Bike Cafe - Cycles Due'; // Report title
    
        $meta = [ // For displaying filters description on header
            'Due Rentals for period' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];

        //dd($fromDate);
    
        $queryBuilder = RentingCycle::select(['user_id', 'total_days', 'to_date', 'cycle_id']) // Do some querying..
                            ->whereBetween('to_date', [date('Y-m-d', strtotime($fromDate)), date('Y-m-d', strtotime($toDate))])
                            ->orderBy($sortBy);
        //dd($queryBuilder);

          
        $columns = [ // Set Column to be displayed
            'Name' => function($result){
                $user = User::where('id', $result->user_id)->firstOrFail();
                return $user ? $user->full_name : '';
            },
            'Mobile' => function($result){
                $user = User::where('id', $result->user_id)->firstOrFail();
                return $user ? $user->mobile  : '';
            },
            'Cycle' => function($result){
                $cycle = Cycle::where('id', $result->cycle_id)->firstOrFail();
                return $cycle ? $cycle->name.' - '.Cycle::TYPE_SELECT[$cycle->type] : '';
            },
            'Total Days', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
            'Due Date' => 'to_date',
            'Status' => function($result) { // You can do if statement or any action do you want inside this closure
                return ($result->to_date > Carbon::now()) ? 'Over Due' : '1 Day to go';
            }
        ];
    
        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReport::of($title, $meta, $queryBuilder, $columns)
                        ->editColumn('Due Date', [ // Change column class or manipulate its data for displaying to report
                            'displayAs' => function($result) {
                                return date('d-m-Y', strtotime($result->to_date));
                            },
                            'class' => 'left'
                        ])
                        ->editColumns(['Total Days', 'Status'], [ // Mass edit column
                            'class' => 'left bold'
                        ])
                        ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                            'Total Days' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                        ])
                        ->limit(20) // Limit record to be showed
                        ->stream(); // other available method: store('path/to/file.pdf') to save to disk, download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
}