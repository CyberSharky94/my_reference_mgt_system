<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $countries = Country::paginate(5);
        return view('system_management.country.index',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('system_management.country.create');
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

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // die();

        $this->validate($request,[

                'name' => 'required|max:60|unique:countries',
                'country_code' => 'required|max:3|unique:countries',
        ]);

        $name = $request->input('name');
        $country_code = $request->input('country_code');


        Country::create([

                'name' => $name,
                'country_code' => $country_code,

        ]);

        return redirect()->route('country.index');
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
        $countries = Country::find($id);
        return view('system_management.country.edit',compact('countries'));
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

        $name = $request->input('name');
        $country_code = $request->input('country_code');

        $input = [

            'name'=>$name,
            'country_code' => $country_code,

        ];


        $this->validate($request,[

                'name'=>'required|max:60',
                'country_code'=>'required|max:3',

            ]);

        Country::where('id',$id)->update($input);

        return redirect()->route('country.index');
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
        Country::destroy($id);
        return redirect()->route('country.index');
    }


    public function search(Request $request){

        $constraint = [

            'name' => $request->input('name'),
            'country_code' => $request->input('country_code'),
        ];


        $countries = $this->doSearchingQuery($constraint);

        return view('system_management.country.index',['countries'=>$countries,'searchingVals'=>$constraint]);
    }


    public function doSearchingQuery($constraint){

        $query = Country::query();

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
