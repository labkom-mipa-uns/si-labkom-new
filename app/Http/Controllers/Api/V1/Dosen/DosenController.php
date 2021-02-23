<?php

namespace App\Http\Controllers\Api\V1\Dosen;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Requests\DosenRequest;
use App\Http\Resources\DosenResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return DosenResource
     */
    public function index(): DosenResource
    {
        return new DosenResource(Dosen::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param DosenRequest $request
     * @return JsonResponse|Response|object
     */
    public function store(DosenRequest $request)
    {
        $dosen = Dosen::create($request->validated());
        return (new DosenResource($dosen))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Dosen $Dosen
     * @return DosenResource
     */
    public function show(Dosen $Dosen): DosenResource
    {
        return new DosenResource($Dosen);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DosenRequest $request
     * @param Dosen $Dosen
     * @return JsonResponse|Response|object
     */
    public function update(DosenRequest $request, Dosen $Dosen)
    {
        $Dosen->update($request->validated());
        return (new DosenResource($Dosen))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Dosen $Dosen
     * @return Response
     * @throws Exception
     */
    public function destroy(Dosen $Dosen): Response
    {
        $this->authorize('delete-data');
        $Dosen->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
