<?php

namespace App\Http\Controllers\Api\V1\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\MahasiswaRequest;
use App\Http\Resources\MahasiswaResource;
use App\Mahasiswa;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return MahasiswaResource
     */
    public function index(): MahasiswaResource
    {
        return new MahasiswaResource(Mahasiswa::with(['prodi'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MahasiswaRequest $request
     * @return JsonResponse|Response|object
     */
    public function store(MahasiswaRequest $request)
    {
        $mahasiswa = Mahasiswa::create($request->validated());
        return (new MahasiswaResource($mahasiswa))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Mahasiswa $Mahasiswa
     * @return MahasiswaResource
     */
    public function show(Mahasiswa $Mahasiswa): MahasiswaResource
    {
        return new MahasiswaResource($Mahasiswa::with(['prodi'])->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MahasiswaRequest $request
     * @param Mahasiswa $Mahasiswa
     * @return JsonResponse|Response|object
     */
    public function update(MahasiswaRequest $request, Mahasiswa $Mahasiswa)
    {
        $Mahasiswa->update($request->validated());
        return (new MahasiswaResource($Mahasiswa))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Mahasiswa $Mahasiswa
     * @return Response
     * @throws Exception
     */
    public function destroy(Mahasiswa $Mahasiswa): Response
    {
        $this->authorize('delete-data');
        $Mahasiswa->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
