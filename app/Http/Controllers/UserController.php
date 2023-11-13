<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
use App\Models\User;
use App\Services\UserService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * UserController constructor
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(): View
    {
        $users = User::paginate();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param EditUserRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(EditUserRequest $request, User $user): RedirectResponse
    {
        $this->authorize('update', $user);

        $this->userService->updateUser($request, $user);

        return redirect()->route('admin.users.index');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(User $user): RedirectResponse
    {
        $this->userService->deleteUser($user);

        return redirect()->route('admin.users.index');
    }
}
