<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public $successStatus = 200;

    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term) {
            $results = Client::where('first_name', 'LIKE', '%' . $search_term . '%')->paginate(10);
        } else {
            $results = Client::paginate(10);
        }

        return $results;
    }

    public function show($id)
    {
        return Client::find($id);
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (!Auth::attempt(['email' => request('email'), 'password' => request('password')]))
            return response()->json(['error' => 'Unauthorised'], 200);

        $user = Auth::user();
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['email'] = $user->email;
        $success['first_name'] = $user->first_name;
        $success['last_name'] = $user->last_name;
        return response()->json(array('success' => true, 'result' => $success), $this->successStatus);
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'identity' => 'required|unique:clients,identity',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|unique:clients,phone',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(
                array('success' => false, 'msg' => $validator->errors()),
                200
            );
        }
        
        $input = $request->except(['c_password']);
        $input['name'] = 'test';
        $user = Client::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(
            array('success' => true, 'msg' => 'Pendaftaran berhasil'),
            $this->successStatus
        );
        // return response()->json(['success' => $success], $this->successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
