<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        return Inertia::render('Admin/Users/Index', [
            'filters' => Request::all(['search', 'trashed']),
            'user' => User::orderBy('name', 'asc')
                ->filter(Request::only(['search', 'trashed']))
                ->paginate()
                ->transform(function ($user) {
                    return [
                        'id' => $user->id,
                        'email' => $user->email,
                        'name' => $user->name,
                        'role' => $user->role,
                        'photo' => $user->photo,
                        'deleted_at' => $user->deleted_at
                    ];
                })
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return InertiaResponse
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Admin/Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request): ?RedirectResponse
    {
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'photo' => $request->photo
            ]);
            return Redirect::route('User.index')
                ->with([
                    'name' => 'Data User',
                    'success' => 'Berhasil Ditambahkan!']);
        } catch (Exception $exception) {
            return Redirect::route('User.index')
                ->with([
                    'name' => 'Data User',
                    'error' => "Gagal Ditambahkan! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param User $User
     * @return UserResource
     */
    public function show(User $User): UserResource
    {
        return new UserResource($User);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $User
     * @return RedirectResponse|InertiaResponse
     */
    public function edit(User $User)
    {
        try {
            if (Auth::id() !== $User->id) {
                $this->authorize('update-data');
            }
            return Inertia::render('Admin/Users/Edit', [
                'user' => [
                    'id' => $User->id,
                    'name' => $User->name,
                    'email' => $User->email,
                    'role' => $User->role,
                    'photo' => $User->photo
                ]
            ]);
        } catch (AuthorizationException $exception) {
            return Redirect::route('User.index')
                ->with([
                    'name' => 'Data User',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $User
     * @return RedirectResponse
     */
    public function update(UserRequest $request, User $User): ?RedirectResponse
    {
        try {
            $User->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => (empty($request->newPassword)) ?
                    $request->password : Hash::make($request->newPassword),
                'role' => $request->role,
                'photo' => $request->photo
            ]);
            return Redirect::route('User.index')
                ->with([
                    'name' => 'Data User',
                    'success' => 'Berhasil Diubah!']);
        } catch (Exception $exception) {
            return Redirect::route('User.index')
                ->with([
                    'name' => 'Data User',
                    'error' => "Gagal Diubah! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $User
     * @return RedirectResponse
     */
    public function destroy(User $User): ?RedirectResponse
    {
        try {
            $this->authorize('delete-data');
            $User->delete();
            return Redirect::route('User.index')
                ->with([
                    'name' => 'Data User',
                    'success' => 'Berhasil Dihapus!']);
        } catch (Exception $exception) {
            return Redirect::route('User.index')
                ->with([
                    'name' => 'Data User',
                    'error' => "Gagal Dihapus! {$exception->getMessage()}"
                ]);
        }
    }

    /**
     * @param User $User
     * @return RedirectResponse
     */
    public function restore(User $User): RedirectResponse
    {
        $User->restore();
        return Redirect::route('User.index')
            ->with([
                'name' => 'Data User',
                'success' => 'Berhasil Dipulihkan!'
            ]);
    }
}
