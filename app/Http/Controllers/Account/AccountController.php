<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
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
     * @return Application|Factory|View
     */
    public function index(): View
    {
        return view('Account.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $Account
     * @return \Illuminate\Http\Response
     */
    public function show(User $Account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $Account
     * @return void
     */
    public function edit(User $Account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User $Account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $Account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $Account
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $Account)
    {
        //
    }
}
