<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Country;
use App\Employee;

class EmployeeController extends Controller
{   

    public function __construct(){
        
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
        $employees = DB::table('employees')
            ->select('employees.*','countries.name as country_name')
            ->leftJoin('countries','employees.country_id','=','countries.id')
            ->paginate(5);


        return view('employee_management.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $countries = Country::all();

        return view('employee_management.create',compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  
        $this->validate($request,[

            'lastname' => 'required|max:60',
            'firstname' => 'required|max:60',
            'middlename' => 'required|max:60',
            'address' => 'required|max:120',
            'country_id'=>'required',
            'age'=>'required',
            'birthdate'=>'required',
            'date_hired'=>'required',
        ]);

        $path = $request->file('picture')->store('public/pic_employee');

        $imagePath = explode('/',$path);

        $imagePath = $imagePath[1]."/".$imagePath[2];

        Employee::create([

            'lastname' => $request->input('lastname'),
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'address' => $request->input('address'),
            'country_id' => $request->input('country_id'),
            'age' => $request->input('age'),
            'birthdate' => date('Y-m-d',strtotime(str_replace('/','-',$request->input('birthdate')))),
            'date_hired' =>date('Y-m-d',strtotime(str_replace('/','-',$request->input('date_hired')))),
            'picture' => $imagePath,
        ]);

        $data = [

            'email' => 'test@gmail.com',
            'name' => 'farid',
            'from' => 'admin@admin.com',
            'mesej' => 'Permohonan anda Berjaya di hantar',
        ];


    \Mail::send('email.email-shipped', $data , function($message) use ($data){

    $message->to($data['email'])->from($data['from'])->subject('Pendafataran Berjaya');
    });




        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employees = Employee::find($id);

        $countries = Country::all();

        return view('employee_management.edit',['employees'=>$employees, 'countries' => $countries ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $this->validate($request,[

            'lastname' => 'required|max:60',
            'firstname' => 'required|max:60',
            'middlename' => 'required|max:60',
            'address' => 'required|max:120',
            'country_id'=>'required',
            'age'=>'required',
            'birthdate'=>'required',
            'date_hired'=>'required',

        ]);

        $input = [

                'lastname' => $request->input('lastname'),
                'firstname' => $request->input('firstname'),
                'middlename' => $request->input('middlename'),
                'address' => $request->input('address'),
                'country_id' => $request->input('country_id'),
                'age' => $request->input('age'),
                'birthdate' => date('Y-m-d',strtotime(str_replace('/','-',$request->input('birthdate')))),
                'date_hired' => date('Y-m-d',strtotime(str_replace('/','-',$request->input('date_hired')))),
        ];


        //checking upload
        if($request->file('picture')){

            $path = $request->file('picture')->store('public/pic_employee');

            $imagePath = explode('/',$path);

            $imagePath = $imagePath[1]."/".$imagePath[2];

            $input['picture'] = $imagePath;

        }

        Employee::where('id',$id)->update($input);

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        Employee::destroy($id);

        return redirect()->route('employee.index');


    }

     public function search(Request $request){

        $constraint = [

            'firstname' => $request->input('firstname'),
            'countries.name' => $request->input('country_name'),
        ];


        $employees = $this->doSearchingQuery($constraint);

        $constraint['country_name'] = $request->input('country_name');

        return view('employee_management.index',['employees'=>$employees,'searchingVals'=>$constraint]);
    }


    public function doSearchingQuery($constraint){

        $query = DB::table('employees')
            ->select('employees.*','countries.name as country_name')
            ->leftJoin('countries','employees.country_id','=','countries.id');

        $field = array_keys($constraint);

        $index = 0;

        foreach($constraint as $cons){

            if($constraint != null){

                $query = $query->where( $field[$index], 'like', '%'.$cons.'%');
            }


            $index++;
        }


        return $query->paginate(5);
    }
}
