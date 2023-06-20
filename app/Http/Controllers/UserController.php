<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    // mostrar la vista de los usurarios
    public function showAllUsers(){
        $users = $this->getAllUsers()->original['users'];
        return view('users.index', compact('users'));
    }

    public function showEditUser(User $user){
        $user->load('roles');
        $roles = $this->getAllRoles()->original['roles'];
        return view('users.edit-user', compact('user', 'roles'));
        /*
        antes de usar roles
        return view('users.edit-user', compact('user');
        */
    }

    public function showCreateUser(){
        $roles = $this->getAllRoles()->original['roles'];
        return view('users.create-user', compact('roles'));
        /*
        antes de usar roles
        return view('users.create-user');
        */
    }

    public function getAllUsers()
    {
        $users = User::get();
        return response()->json(['users' => $users],200);
    }

    public function getAllRoles(){
        $roles = Role::all()->pluck('name');
        return response()->json(['roles' => $roles], 200);
    }

    public function getAllUsersWithLends()
    {
        $users = User::with('CustomerLends.Book')->get();
        return response()->json(['users' => $users],200);
    }

    /*
    otro tipo consulta usando where
    public function getAllUsersWithLends()
    {
        $users = User::with('CustomerLends.Book')->has('CustomerLends.Book')->where('id', 10)->get();
        return response()->json(['users' => $users],200);
    }
    */
    /*
    //Traeriamos los usarios solo tienen prestamo
    public function getAllUsersWithLends()
    {
        $users = User::with('CustomerLends.Book')->has('CustomerLends.Book')->get();
        return response()->json(['users' => $users],200);
    }
    */

    public function getAllLendsByUser(User $user)
    {
        $CustomerLends = $user->load('CustomerLends.Book.Category','CustomerLends.Book.Author')->CustomerLends;
        return response()->json(['customer_lends' => $CustomerLends],200);
    }
    /*
    public function getAnUser($user)
    {
        $user = User::find($user);
        return response()->json(['user' => $user],200); //forma usualmente ellos usan
    }
    forma alternativa abajo
    */

    public function getAnUser(User $user)
    {
        return response()->json(['user' => $user],200); //forma usualmente ellos usan
    }
    /*
    public function createUser(Request $request)
    {
        // dd($request);  //para ver toda la consulta
        return response()->json(['user' => $request->all()], 200);
    }
    para postman
    */

    /*
    //sin untilizar los request de CreateUserRequest
    public function createUser(Request $request)
    {
        $user = new User($request->all());
        $user->save();
        return response()->json(['user' => $user], 201);
    }
    */

    public function createUser(CreateUserRequest $request)
    {
        try{
            DB::beginTransaction();
            $user = new User($request->all());
            $user->save();
            $user->assignRole($request->role);
            DB::commit();

            if($request->ajax()) return response()->json(['user'=>$user], 201);
            return back()->with('success','Usuario Creado');
        }
        catch (\Throwable $th){
            DB::rollback();
            throw $th;
        }
        /*
        Realizar transaciones tenemos
        $user = new User($request->all());
        $user->save();
        if($request->ajax()) return response()->json(['user'=>$user], 201);
        return back()->with('success','Usuario Creado');
        */
    }


    // Es la forma que se usa

    /*
    public function createUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->password = $request->password;
        $user->email = $request->email;
        $user->number_id = $request->number_id;
        $user->save();
        return response()->json(['user' => $user], 201);
    }
    otra forma de hacer el create
    */

    /*
    sin el http request
    public function updateUser(User $user, Request $request)
    {
        $user->update($request->all());
        return response()->json(['user' => $user->refresh()], 201);
    }
    */
    public function updateUser(User $user, UpdateUserRequest $request)
    {

        try{
            DB::beginTransaction();
            $allRequest = $request->all();
            if(!isset($allRequest['password'])){
                if(!$allRequest['password']) {
                    unset($allRequest['password']);
                }
            }
            $user->update($allRequest);
            $user->syncRoles([$request->role]);
            DB::commit();

            if($request->ajax()) return response()->json(['user' => $user->refresh()], 201);
            return back()->with('success','Usuario editado');
        }
        catch (\Throwable $th){
            DB::rollback();
            throw $th;
        }
/* de esto
        $allRequest = $request->all();
        //dd(isset($allRequest['password']));
        /*
        if(isset($allRequest['password'])){
            if(!$allRequest['password']) {
                unset($allRequest['password']);
            }
        } //acá acababa antes

        if(!isset($allRequest['password'])){
            if(!$allRequest['password']) {
                unset($allRequest['password']);
            }
        }


        //dd($allRequest);
        $user->update($allRequest);
        #dd($user);
        if($request->ajax()) return response()->json(['user' => $user->refresh()], 201);
        return back()->with('success','Usuario editado');
        */
    }


    public function deleteAUser(User $user, Request $request)
    {
        /*
        sin la vista
        $user->delete();
        return response()->json([], 204);
        */
        $user->delete();
        if($request->ajax()) return response()->json([], 204);
        return back()->with('success','Usuario eliminado');
    }

}
