<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\User;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function index()
    {
        try {
            $data = [
                'User' => User::orderBy('name','asc')->paginate(8)
            ];
            return view('User.index', $data);
        } catch (Exception $exception) {
            return redirect()->home()->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|RedirectResponse|Response|View
     */
    public function create()
    {
        try {
            return view('User.create');
        } catch (Exception $exception) {
            return redirect()->route('User.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): ?RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        try {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            return redirect()->route('User.index')
                ->with('success', "Berhasil Ditambahkan!");
        } catch (Exception $exception) {
            return redirect()->route('User.index')
                ->with('danger', "Gagal Ditambahkan! {$exception->getMessage()}");
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
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(User $User)
    {
        try {
            $this->authorize('update-data');
            $data = [
                'User' => $User
            ];
            return view('User.edit', $data);
        } catch (AuthorizationException $exception){
            return redirect()->route('User.index')
                ->with('danger', $exception->getMessage());
        } catch (Exception $exception) {
            return redirect()->route('User.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $User
     * @return RedirectResponse
     */
    public function update(Request $request, User $User): ?RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'newPassword' => ['confirmed'],
        ]);
        try {
            User::whereId($User->id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => (empty($request['newPassword'])) ?
                    $request['password'] : Hash::make($request['newPassword']),
                'role' => $request['role']
            ]);
            return redirect()->route('User.index')
                ->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('User.index')
                ->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
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
            User::destroy($User->id);
            return redirect()->route('User.index')
                ->with('success', "Berhasil Dihapus!");
        } catch (Exception $exception) {
            return redirect()->route('User.index')
                ->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }
}
