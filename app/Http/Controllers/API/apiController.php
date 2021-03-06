<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\API\analyzes;
use App\models\API\Rays;
use App\models\Faviorate;
use App\models\OnlineDoctor;
use App\models\Patien;
use Illuminate\Support\Facades\Validator;
use App\models\Medication2;

class apiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
    /* function analzes index*/
    public function analyzesIndex(){

        // $analyzes = analyzes::get();
        // return response()->json([
        //     'data'  => $analyzes,
        //     'msg'   => 'all data analyzes',
        //     'status'    => true
        // ]);


        try{
            $rays = analyzes::get(['id','name']);
            if($rays->count() > 0){
                return response()->json([
                    'data'  => $rays,
                    'message'   => 'success message',
                    'status'=> true
                ]);
            }
            return response()->json([
                'msg'   => 'not found',
                'status'=> false
            ],400);

        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false
            ],500);
        }

    }
    /* end of function analzes index*/
    /* function analyzesStore */
    public function analyzesStore(Request $request){
        $arr = [
            'name' => 'required',
        ];

        $vaild = Validator::make($request->all(),$arr);
        if($vaild->fails()){
            return response()->json($vaild->errors());
        }

        $analyzes_create = analyzes::create([
            'name'  => $request->name
        ]);
        return response()->json([
            'data' => $analyzes_create,
            'msg'   => 'data created successfuly',
        ]);
    }
    /* end of function analyzesStore */


    /* function analyzesSearch */
    public function analyzesSearch(Request $request){
        $analyzes_search = analyzes::where('name','like','%' . $request->search . '%')->first();
        return response()->json([
            'data'  => $analyzes_search,
            'status'=> true
        ]);
    }
    /* function analyzesSearch */

    /* function rays index */
    public function raysIndex(){

        // $rays = Rays::get();
        // return response()->json([
        //     'data'  => $rays,
        //     'msg'   => 'all data rays',
        //     'status'=> true
        // ]);


        try{
            $rays = Rays::get(['id','name']);
            if($rays->count() > 0){
                return response()->json([
                    'data'  => $rays,
                    'message'   => 'success message',
                    'status'=> true
                ]);
            }
            return response()->json([
                'msg'   => 'not found',
                'status'=> false
            ],400);

        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false
            ],500);
        }

    }
    /* end of function rays index */

    public function getAllMedication(){
        try{
            // $data = Category::paginate(request()->all());
            // $medication = Medication2::get(['id','name']);
            $medication = Medication2::paginate(50);
            if($medication){
                return response()->json([
                    'data' => $medication,
                    'message' => 'success message',
                    'status' => true
                ]);
            }
            return response()->json([

                'message' => 'not found',
                'status' => false
            ],400);
        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => false
            ],500);
        }
    }

    /* function rays store */
    function raysStore(Request $request){
        $arr = [
            'name'  => 'required',
        ];

        $vaild = Validator::make($request->all(),$arr);
        if($vaild->fails()){
            return response()->json($vaild->errors());
        }

        $rays_create = Rays::create([
            'name'  => $request->name,
        ]);

        return response()->json([
            'data'  => $rays_create,
            'msg'    => 'data created successfuly',
        ]);
    }

    /* end of function rays store */

    public function raysSearch(Request $request){
        $rays_search = Rays::where('name','like','%' . $request->search . '%')->first();
        if($rays_search == true){
            return response()->json([
                'data'  => $rays_search,
                'status'=> true
            ]);
        }
        return response()->json([
            'data'  => $rays_search,
            'status'=> false,
            'msg'   => 'error'
        ]);

    }

    // public function getAllMedication(){
    //     try{
    //         $medication = Medication2::get(['id','name']);
    //         if($medication){
    //             return response()->json([
    //                 'data' => $medication,
    //                 'message' => 'success message',
    //                 'status' => true
    //             ]);
    //         }
    //         return response()->json([

    //             'message' => 'not found',
    //             'status' => false
    //         ],400);
    //     }catch(\Exception $ex){
    //         return response()->json([
    //             'message' => $ex->getMessage(),
    //             'status' => false
    //         ],500);
    //     }
    // }

}
