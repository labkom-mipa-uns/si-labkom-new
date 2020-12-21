<?php

namespace App\Http\Controllers\Api\V1\Alat;

use App\Alat;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlatRequest;
use App\Http\Resources\AlatResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AlatResource
     */
    public function index(): AlatResource
    {
        return new AlatResource(Alat::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AlatRequest $request
     * @return JsonResponse|Response|object
     */
    public function store(AlatRequest $request)
    {
        $alat = Alat::create($request->validated());
        return (new AlatResource($alat))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Alat $Alat
     * @return AlatResource
     */
    public function show(Alat $Alat): AlatResource
    {
        return new AlatResource($Alat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AlatRequest $request
     * @param Alat $Alat
     * @return JsonResponse|Response|object
     */
    public function update(AlatRequest $request, Alat $Alat)
    {
        $Alat->update($request->validated());
        return (new AlatResource($Alat))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Alat $Alat
     * @return Response
     * @throws Exception
     */
    public function destroy(Alat $Alat): Response
    {
        $this->authorize('delete-data');
        $Alat->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
