<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;
use App\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|RedirectResponse|View
     */
    public function index()
    {
        try {
            $data = [
                'User' => Auth::user()
            ];
            return view('Account.index', $data);
        } catch (Exception $exception) {
            return redirect()->route('Account.index')
                ->with('warning', "Silakan Coba Beberapa Saat Lagi! {$exception->getMessage()}");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return RedirectResponse
     */
    public function create(): RedirectResponse
    {
        return redirect()->route('Account.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('Account.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $Account
     * @return AccountResource
     */
    public function show(User $Account): AccountResource
    {
        return new AccountResource($Account);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param User $Account
     * @return Application|Factory|RedirectResponse|View
     */
    public function edit(User $Account)
    {
        try {
            $data = [
                'User' => $Account
            ];
            return view('Account.edit', $data);
        } catch (Exception $exception) {
            return redirect()->route('Account.index')
                ->with("Gagal Diupdate! {$exception->getMessage()}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $Account
     * @return RedirectResponse
     */
    public function update(Request $request, User $Account): ?RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'newPassword' => ['confirmed'],
        ]);
        try {
            User::whereId($Account->id)->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => (empty($request['newPassword'])) ? $request['password'] : Hash::make($request['newPassword']),
                'role' => $request['role']
            ]);
            return redirect()->route('Account.index')
                ->with('success', "Berhasil Diupdate!");
        } catch (Exception $exception) {
            return redirect()->route('Account.index')
                ->with('danger', "Gagal Diupdate! {$exception->getMessage()}");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $Account
     * @return RedirectResponse
     */
    public function destroy(User $Account): ?RedirectResponse
    {
        try {
            User::destroy($Account->id);
            return redirect()->route('welcome');
        } catch (Exception $exception) {
            return redirect()->route('Account.index')
                ->with('danger', "Gagal Dihapus! {$exception->getMessage()}");
        }
    }
}
