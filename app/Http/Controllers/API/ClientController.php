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

        $client_info['client_id'] = $user->id;
        $client_info['first_name'] = $user->first_name;
        $client_info['last_name'] = $user->last_name;
        $client_info['identity'] = $user->identity;
        $client_info['email'] = $user->email;
        $client_info['phone'] = $user->phone;
        return response()->json(array('success' => true, 'result' => $success, 'client_info' => $client_info), $this->successStatus);
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
        $user = Client::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        return response()->json(
            array('success' => true, 'msg' => 'Pendaftaran berhasil'),
            $this->successStatus
        );
        // return response()->json(['success' => $success], $this->successStatus);
    }

    public function update($id, Request $request)
    {
        $client = Client::find($id);
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'identity' => 'required|unique:clients,identity,' . $id,
            'email' => 'required|email|unique:clients,email,' . $id,
            'phone' => 'required|unique:clients,phone,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(array('success' => false, 'msg' => $validator->errors()), 200);
        }

        if (!is_null($input['password'] ?? null) && !is_null($input['new_password'] ?? null)) {
            if (Hash::check($input['password'], $client->password)) {
                $client->fill([
                    'password' => $request['new_password']
                ])->save();
            } else {
                return response()->json(
                    array('success' => false, 'msg' => ["password" => "Kata sandi lama tidak sesuai."]),
                    $this->successStatus
                );
            }
        }
        $client->first_name = $input['first_name'];
        $client->last_name = $input['last_name'];
        $client->identity = $input['identity'];
        $client->email = $input['email'];
        $client->phone = $input['phone'];
        $client->save();

        return response()->json(
            array('success' => true, 'msg' => 'Profil berhasil diubah'),
            $this->successStatus
        );
    }

    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
