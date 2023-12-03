<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $data = DB::table('shops')->get();
        return view('admin.index', ['products' => $data]);
    }

    public function store(Request $request)
    {
        $title = $request->title;
        $unit_price = $request->unit_price;
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }
        $tambah = DB::table('shops')->insert([
            'title' => $title,
            'unit_price' => $unit_price,
            'image' => 'http://127.0.0.1:8000/' . $destinationPath . $profileImage
        ]);
        return redirect()->route('admin.index')->with('success', 'Product Added Successfully');
    }

    public function edit($id)
    {
        $product = DB::table('shops')->where('id', $id)->first();
        return view('admin.edit', ['product' => $product]);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }
        $update = DB::table('shops')->where('id', $request->id)->update([
            'title' => $request->title,
            'unit_price' => $request->unit_price,
            'image' => $destinationPath . $profileImage
        ]);
        return redirect()->route('admin.index')->with('success', 'Product Update Successfully');
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $delete = DB::table('shops')->where('id', $id)->delete();
        return redirect()->route('admin.index')->with('success', 'Product Delete Successfully');
    }
    public function create(){
        return view('admin.create');
    }

    //Login Register
    public function viewlogin()
    {
        return view('login');
    }

    public function viewregister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $username = $request->username;
        $email = $request->email;
        $password = bcrypt($request->password);

        $register = DB::table('users')->insert([
            'name' => $username,
            'email' => $email,
            'password' => $password
        ]);

        return redirect()->to('/auth/login');
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt([
            'email' => $email,
            'password' => $password
        ])) {
            return redirect()->route('pesan.home');
        } else {
            return redirect()->to('/auth/login');
        }
    }
}
