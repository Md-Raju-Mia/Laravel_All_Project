<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getUsers(Request $request)
    {
        $columns = ['id', 'name', 'email'];
        $totalData = User::count();

        $limit = $request->input('length');
        $start = $request->input('start');
        $orderColumnIndex = $request->input('order.0.column');
        $orderColumn = $columns[$orderColumnIndex];
        $orderDir = $request->input('order.0.dir');
        $searchValue = $request->input('search.value');

        // Initial query
        $query = User::query();

        // Filtering
        if (!empty($searchValue)) {
            $query->where('name', 'LIKE', "%{$searchValue}%")
                ->orWhere('email', 'LIKE', "%{$searchValue}%");
        }

        $totalFiltered = $query->count();

        // Pagination and ordering
        $users = $query->offset($start)
            ->limit($limit)
            ->orderBy($orderColumn, $orderDir)
            ->get();

        // Mapping data for the response
        $data = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'action' => '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>
                         <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>'
            ];
        })->toArray();

        // Preparing JSON response
        $json_data = [
            "draw" => intval($request->input('draw')),
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalFiltered,
            "data" => $data
        ];

        return response()->json($json_data);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email'
        ], [
            'name.required' => 'Name is Required',
            'email.unique' => 'User Already Exists',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'status' => 'success',
        ]);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id
        ], [
            'name.required' => 'Name is Required',
            'email.unique' => 'User Already Exists',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return response()->json(['status' => 'success']);
    }

    //delete id row
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }
}
