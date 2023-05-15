<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\product;
use App\Models\cart;
use App\Models\order;
use Session;
class AuthController extends Controller
{
    public function index(Request $req)
    {
        $req->validate([
            'name'=>'required',
            'email'=>'required',
            'password' => 'required|min:8|confirmed',

        ]);
        $member = new member;
        $member->name=$req->name;
        $member->email=$req->email;
        $member->password = bcrypt($req->password);
        $member->save();
        return redirect('login');
    }

    function login(Request $req)
    {
        $member= Member::where(['email'=>$req->email])->first();
        if(!$member || !Hash::check($req->password,$member->password))
        {
            return "Username or password is not matched";
        }
        else{
            $req->session()->put('user',$member);
            return redirect('/dash');
        }
    }

public function dash()
    {
        $data= product::all();
        return view('dashboard', ['products'=>$data]);


    }

function detail($id)
{
    $data =product::find($id);
    return view('detail', ['product'=>$data]);
}

function search(Request $req)
    {
        $data= Product::
        where('name', 'like', '%'.$req->input('query').'%')
        ->get();
        return view('search',['products'=>$data]);
    }


    function addToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
           $cart= new cart;
           $cart->member_id=$req->session()->get('user')['id'];
           $cart->product_id=$req->product_id;
           $cart->save();
           return redirect('/dash');


        }
        else
        {
            return redirect('/login');

        }
    }

    static function cartItem()
    {
     $userId=Session::get('user')['id'];
     return Cart::where('member_id',$userId)->count();
    }

    function cartList()
    {
        $userId=Session::get('user')['id'];
       $products= DB::table('carts')
        ->join('products','carts.product_id','=','products.id')
        ->where('carts.member_id',$userId)
        ->select('products.*','carts.id as carts_id')
        ->get();

        return view('cartlist',['products'=>$products]);
    }

    function removeCart($id)
    {
        Cart::destroy($id);
        return redirect('cartlist');
    }

    function orderNow()
    {
        $userId=Session::get('user')['id'];
        $total= $products= DB::table('carts')
         ->join('products','carts.product_id','=','products.id')
         ->where('carts.member_id',$userId)
         ->sum('products.price');

         return view('ordernow',['total'=>$total]);
    }

    function orderPlace(Request $req)
    {
        $userId=Session::get('user')['id'];
         $allCart= Cart::where('member_id',$userId)->get();
         foreach($allCart as $cart)
         {
             $order= new Order;
             $order->product_id=$cart['product_id'];
             $order->member_id=$cart['member_id'];
             $order->status="pending";
             $order->payment_method=$req->payment;
             $order->payment_status="pending";
             $order->address=$req->address;
             $order->save();
             Cart::where('member_id',$userId)->delete();
         }
         $req->input();
         return redirect('/dash');
    }

}
