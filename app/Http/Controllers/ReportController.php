<?php
/******************************************************************************
Instruction : 

For make pdf can follow this documentation
https://github.com/barryvdh/laravel-dompdf


For make excel can follow this documentation
https://github.com/Maatwebsite/Laravel-Excel


********************************************************************************/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use Illuminate\Support\Facades\DB;

use PDF; 
use Auth;
use Excel;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $format = 'd/m/Y';
        $now = date($format);
        $to = date($format, strtotime("+30 days"));

        $constraints = [
            'from' => $now,
            'to' => $to
        ];

        $employees = $this->getHiredEmployees($constraints);
        return view('system_management.report.index', ['employees' => $employees, 'searchingVals' => $constraints]);
    }

    private function getHiredEmployees($constraints) {

        $from = date('Y-m-d',strtotime(str_replace('/', '-', $constraints['from']) ));
        $to = date('Y-m-d',strtotime(str_replace('/', '-', $constraints['to']) ));

        $employees = Employee::where('date_hired', '>=', $from)
            ->where('date_hired', '<=', $to)
            ->get();
        return $employees;
    }

    public function search(Request $request) {
        $constraints = [
            'from' => $request['from'],
            'to' => $request['to']
        ];

        $employees = $this->getHiredEmployees($constraints);
        return view('system_management.report.index', ['employees' => $employees, 'searchingVals' => $constraints]);
    }

    public function exportPDF(Request $request) {

        $from = date('Y-m-d',strtotime(str_replace('/', '-', $request->input('from')) ));
        $to = date('Y-m-d',strtotime(str_replace('/', '-', $request->input('to')) ));

        $constraints = [
            'from' => $from,
            'to' => $to
        ];
        $employees = $this->getExportingData($constraints);
        $pdf = PDF::loadView('system_management.report.pdf', ['employees' => $employees, 'searchingVals' => $constraints]);
        return $pdf->download('report_from_'. $from.'_to_'.$to.'.pdf');
        // return view('system-mgmt/report/pdf', ['employees' => $employees, 'searchingVals' => $constraints]);
    }

    private function getExportingData($constraints) {
        return DB::table('employees')
            ->leftJoin('countries', 'employees.country_id', '=', 'countries.id')
            ->select('employees.firstname', 'employees.middlename', 'employees.lastname',
                'employees.age','employees.birthdate', 'employees.address', 'employees.date_hired',
                 'countries.name as country_name')
            ->where('date_hired', '>=', $constraints['from'])
            ->where('date_hired', '<=', $constraints['to'])
            ->get()
            ->map(function ($item, $key) {
                return (array) $item;
            })
            ->all();
    }

    public function exportExcel(Request $request) {
        ob_end_clean();

        ob_start();

        $this->prepareExportingData($request)->export('xlsx');

        return redirect()->route('report.index');
    }

    public function prepareExportingData($request) {
        $author = Auth::user()->username;

        $from = date('Y-m-d',strtotime(str_replace('/', '-', $request->input('from')) ));
        $to = date('Y-m-d',strtotime(str_replace('/', '-', $request->input('to')) ));

        $employees = $this->getExportingData(['from'=> $from, 'to' => $to]);
        return Excel::create('report_from_'. $request['from'].'_to_'.$request['to'], function($excel) use($employees, $request, $author) {

            $excel->sheet('Hired_Employees', function($sheet) use($employees) {

                $sheet->fromArray($employees);
            });
        });
    }


}
