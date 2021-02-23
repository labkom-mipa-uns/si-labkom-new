<?php

namespace App\Http\Controllers\Api\V1\Jadwal;

use App\Http\Controllers\Controller;
use App\Http\Requests\JadwalRequest;
use App\Http\Resources\JadwalResource;
use App\Jadwal;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JadwalResource
     */
    public function index(): JadwalResource
    {
        return new JadwalResource(Jadwal::with(['prodi', 'dosen', 'matakuliah'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JadwalRequest $request
     * @return JsonResponse|Response|object
     */
    public function store(JadwalRequest $request)
    {
        $jadwal = Jadwal::create($request->validated());
        return (new JadwalResource($jadwal))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Jadwal $Jadwal
     * @return JadwalResource
     */
    public function show(Jadwal $Jadwal): JadwalResource
    {
        return new JadwalResource($Jadwal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JadwalRequest $request
     * @param Jadwal $Jadwal
     * @return JsonResponse|Response|object
     */
    public function update(JadwalRequest $request, Jadwal $Jadwal)
    {
        $Jadwal->update($request->validated());
        return (new JadwalResource($Jadwal))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Jadwal $Jadwal
     * @return Response
     * @throws Exception
     */
    public function destroy(Jadwal $Jadwal): Response
    {
        $this->authorize('delete-data');
        $Jadwal->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
