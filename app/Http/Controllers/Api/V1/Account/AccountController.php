<?php

namespace App\Http\Controllers\Api\V1\Account;

use App\Account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): ?Response
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Account $account
     * @return void
     */
    public function show(Account $account): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Account $account
     * @return void
     */
    public function update(Request $request, Account $account): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Account $account
     * @return void
     */
    public function destroy(Account $account): void
    {
        //
    }
}
