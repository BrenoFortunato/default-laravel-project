<?php

namespace App\Http\Controllers;

use Auth;
use Flash;
use Response;
use App\DataTables\UserDataTable;
use App\Repositories\UserRepository;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\AppBaseController;
use Spatie\Permission\Models\Role;

class UserController extends AppBaseController
{
    private $userRepository;

    /**
     * Create a new controller instance
     * 
     * @param UserRepository $userRepo
     *
     * @return void
     */
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User
     *
     * @param UserDataTable $userDataTable

     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render("users.index");
    }

    /**
     * Show the form for creating a new User
     *
     * @return Response
     */
    public function create()
    {
        $rolesArray = Role::orderBy("id")->pluck("display_name", "name")->toArray();

        return view("users.create", compact("rolesArray"));
    }

    /**
     * Store a newly created User in storage
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $user = $this->userRepository->create($input);
        $user->assignRole($input["role_name"]);

        Flash::success(\Lang::choice("tables.users", "s")." ".\Lang::choice("flash.saved", "m"));
        return redirect(route("users.index"));
    }

    /**
     * Display the specified User
     *
     * @return Response
     */
    public function show()
    {
        $user = $this->userRepository->find(request()->user_id);
        if (empty($user)) {
            Flash::error(\Lang::choice("tables.users", "s")." ".\Lang::choice("flash.not_found", "m"));
            return redirect(route("users.index"));
        }

        return view("users.show", compact("user"));
    }

    /**
     * Show the form for editing the specified User
     *
     * @return Response
     */
    public function edit()
    {
        $user = $this->userRepository->find(request()->user_id);
        if (empty($user)) {
            Flash::error(\Lang::choice("tables.users", "s")." ".\Lang::choice("flash.not_found", "m"));
            return redirect(route("users.index"));
        }

        $rolesArray = Role::orderBy("id")->pluck("display_name", "name")->toArray();

        return view("users.edit", compact("user", "rolesArray"));
    }

    /**
     * Update the specified User in storage
     *
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update(UpdateUserRequest $request)
    {
        $user = $this->userRepository->find(request()->user_id);
        if (empty($user)) {
            Flash::error(\Lang::choice("tables.users", "s")." ".\Lang::choice("flash.not_found", "m"));
            return redirect(route("users.index"));
        }

        $input = $request->all();
        $user = $this->userRepository->update($input, $user->id);
        $user->syncRoles($input['role_name']);

        Flash::success(\Lang::choice("tables.users", "s")." ".\Lang::choice("flash.updated", "m"));
        return redirect(route("users.index"));
    }

    /**
     * Remove the specified User from storage
     *
     * @return Response
     */
    public function destroy()
    {
        $user = $this->userRepository->find(request()->user_id);
        if (empty($user)) {
            Flash::error(\Lang::choice("tables.users", "s")." ".\Lang::choice("flash.not_found", "m"));
            return redirect(route("users.index"));
        }

        if ($user->id == Auth::user()->id) {
            Flash::error(\Lang::get("flash.self_delete"));
            return redirect(route("users.index"));
        }

        try { 
            $this->userRepository->delete($user->id);
        } catch(\Exception $e) {
            Flash::error(\Lang::choice("tables.users", "s")." ".\Lang::choice("flash.not_deleted", "m"));
            return redirect(route("users.index"));
        }

        Flash::success(\Lang::choice("tables.users", "s")." ".\Lang::choice("flash.deleted", "m"));
        return redirect(route("users.index"));
    }
}
