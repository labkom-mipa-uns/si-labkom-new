<?php

namespace App\Http\Controllers\Api\V1\PeminjamanAlat;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeminjamanAlatRequest;
use App\Http\Resources\PeminjamanAlatResource;
use App\PeminjamanAlat;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PeminjamanAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PeminjamanAlatResource
     */
    public function index(): PeminjamanAlatResource
    {
        return new PeminjamanAlatResource(PeminjamanAlat::with(['alat', 'mahasiswa'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PeminjamanAlatRequest $request
     * @return JsonResponse|Response|object
     */
    public function store(PeminjamanAlatRequest $request)
    {
        $peminjamanalat = PeminjamanAlat::create($request->validated());
        return (new PeminjamanAlatResource($peminjamanalat))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param PeminjamanAlat $PeminjamanAlat
     * @return PeminjamanAlatResource
     */
    public function show(PeminjamanAlat $PeminjamanAlat): PeminjamanAlatResource
    {
        return new PeminjamanAlatResource($PeminjamanAlat::with(['alat', 'mahasiswa'])->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PeminjamanAlatRequest $request
     * @param PeminjamanAlat $PeminjamanAlat
     * @return JsonResponse|Response|object
     */
    public function update(PeminjamanAlatRequest $request, PeminjamanAlat $PeminjamanAlat)
    {
        $PeminjamanAlat->update($request->validated());
        return (new PeminjamanAlatResource($PeminjamanAlat))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PeminjamanAlat $PeminjamanAlat
     * @return Response
     * @throws Exception
     */
    public function destroy(PeminjamanAlat $PeminjamanAlat): Response
    {
        $PeminjamanAlat->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
