<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $perPage = 10;
    use SoftDeletes;

    protected $fillable = [
        'email',
        'password',
        'name',
        'address',
        'phone',
        'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const ADMIN = 1;
    const GUESS = 2;
    const STAFF = 3;
    const WAREHOUSEMAN = 4;
    const SELLER = 5;
    const SHIPPER = 6;

    public static $roles = [
        self::ADMIN => 'Admin',
        self::GUESS => 'User',
        self::STAFF => 'Staff',
        self::WAREHOUSEMAN => 'Warehouseman',
        self::SELLER => 'Seller',
        self::SHIPPER => 'Shipper',
    ];

    /**
     * Scope a query to find userName.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $userName
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindUserName($query, $userName)
    {
        return $query->where('email', 'like', '%' . $userName . '%');
    }

    /**
     * Scope a query to find name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    /**
     * Scope a query to find address.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $address
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindAddress($query, $address)
    {
        return $query->where('address', 'like', '%' . $address . '%');
    }

    /**
     * Scope a query to find phone.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $phone
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindPhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }

    /**
     * get users info ascending sort by email
     *
     * @param array $data
     * @return \Illuminate\Pagination\Paginator
     */
    public function getUsers($data)
    {
        $builder = $this->orderBy('email');

        if (isset($data['email'])) {
            $builder->findUserName($data['email']);
        }
        if (isset($data['name'])) {
            $builder->findName($data['name']);
        }
        if (isset($data['address'])) {
            $builder->findAddress($data['address']);
        }
        if (isset($data['phone'])) {
            $builder->findPhone($data['phone'])->get();
        }

        return $builder->paginate();
    }

    /**
     * save  user to database
     *
     * @param \App\Http\Requests\StoreUserRequest $request
     * @return User
     */
    public function saveUser($request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        return $this->create($data);
    }

    /**
     * update user in database
     *
     * @param UpdateUserRequest $request
     * @return boolean
     */
    public function updateUser($request)
    {
        $data = $request->all();
        $user = $this->find($request->id);

        $data['email'] = $user->email;
        if (Auth::user()->role == self::GUESS)
            $data['role'] = self::GUESS;

        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        return $this->find($request->id)->update($data);
    }

    /**
     * delete user from database
     *
     * @param integer $id
     * @return bool
     */
    public function deleteUser($id)
    {
        $user = $this->find($id);
        if (!isset($user)) {
            return false;
        }

        return $user->delete();
    }

    public function orders()
    {
        $this->hasMany('App\Models\Order');
    }

    public function orderdetails()
    {
        $this->hasMany('App\Models\Orderdetail');
    }

}
