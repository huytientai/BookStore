<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    protected $user;
    protected $order;

    /**
     * construct class
     *
     * UsersController constructor.
     * @param User $user
     */
    public function __construct(User $user, Order $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('admin', Auth::user()) || Gate::allows('staff', Auth::user())) {
            $users = $this->user->getUsers($request->all());

            return view('users/index')->with('users', $users);
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('admin', Auth::user()) || Gate::allows('staff', Auth::user())) {
            if (Gate::allows('admin', Auth::user())) {
                return view('users/create');
            }
            flash('Ban khong co quyen truy cap')->error();
            return redirect()->route('users.index');
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\StoreUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        if (Gate::allows('admin', Auth::user()) || Gate::allows('staff', Auth::user())) {
            if (Gate::allows('staff', Auth::user())) {
                flash('Ban khong co du quyen')->error();
                return redirect()->route('users.index');
            }

            $user = $this->user->saveUser($request);

            if ($user != null) {
                //set success message
                flash('add thanh cong')->success();
            }

            return redirect()->route('users.index');
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->id == $id || Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            $user = $this->user->find($id);

            if ($user == null) {
                flash('This user was deleted')->warning();
                return redirect()->route('home');
            }

            $orders = $this->order->where('user_id', $id)->whereIn('status', [Order::DONE, Order::SHIPPED])->orderBy('created_at', 'desc')->get();
            return view('users.show')->with(['user' => $user, 'orders' => $orders]);
        }

        flash('You are not authorized')->warning();
        return redirect()->route('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('admin', Auth::user())) {
            $user = $this->user->find($id);
            if (!isset($user)) {
                flash('User not exist')->error();
                return redirect()->route('users.index');
            }
            return view('users.edit')->with('user', $user);
        } elseif (Auth::user()->id == $id) {
//            $user = $this->user->find($id);
            return view('users/edit')->with('user', Auth::user());
        } elseif (Gate::allows('staff', Auth::user())) {
            flash('Ban khong co du quyen')->error();
            return redirect()->route('users.index');
        } else
            return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\UpdateUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request)
    {
        if (Gate::allows('admin', Auth::user())) {
            if ($this->user->updateUser($request)) {
                flash('Cap nhat thanh cong')->success();
            } else {
                flash('Cap nhat that bai')->error();
            }
            return redirect()->route('users.show', $request->id);
        } elseif (Auth::user()->id == $request->id) {
            if ($this->user->updateUser($request)) {
                flash('Cap nhat thanh cong')->success();
            } else {
                flash('Cap nhat that bai')->error();
            }
            return redirect()->route('users.show', Auth::id());
        } elseif (Gate::allows('staff', Auth::user())) {
            flash('Ban khong co du quyen')->error();
            return redirect()->route('users.index');
        } else {
            return redirect()->route('home');
        }

    }

    /**
     * Remove user from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('admin', Auth::user()) || Gate::allows('staff', Auth::user())) {

            if (Gate::allows('staff', Auth::user())) {
                flash('Ban khong co du quyen')->error();
                return redirect()->route('users.index');
            }

            //Check user exist
            $user = $this->user->find($id);
            if ($user == null) {
                flash('Tai khoan khong ton tai')->error();
                return redirect()->route('users.index');
            }

            //check user had order: pay_status, CONFIRM_EXPORT
            $orders = $this->order->where('user_id', $id)->where('status', '!=', Order::DONE)->where(function ($query) {
                $query->where('pay_status', 1)->orWhere('status', '>=', Order::CONFIRM);
            })->get();

            if ($orders->count()) {
                flash('Cant delete this user (This user is buying)')->warning();
                return back();
            }

            // delete user
            if ($this->user->deleteUser($id)) {
                flash('Xoa thanh cong')->success();
            } else {
                flash('Xoa that bai')->error();
            }

            return redirect()->route('users.index');
        } else
            return redirect()->route('home');
    }
}
