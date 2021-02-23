<?php

namespace App\Http\Controllers\Api\V1\MataKuliah;

use App\Http\Controllers\Controller;
use App\Http\Requests\MataKuliahRequest;
use App\Http\Resources\MataKuliahResource;
use App\MataKuliah;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return MataKuliahResource
     */
    public function index(): MataKuliahResource
    {
        return new MataKuliahResource(MataKuliah::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MataKuliahRequest $request
     * @return JsonResponse|Response|object
     */
    public function store(MataKuliahRequest $request)
    {
        $matakuliah = MataKuliah::create($request->validated());
        return (new MataKuliahResource($matakuliah))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param MataKuliah $MataKuliah
     * @return MataKuliahResource
     */
    public function show(MataKuliah $MataKuliah): MataKuliahResource
    {
        return new MataKuliahResource($MataKuliah);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MataKuliahRequest $request
     * @param MataKuliah $MataKuliah
     * @return JsonResponse|Response|object
     */
    public function update(MataKuliahRequest $request, MataKuliah $MataKuliah)
    {
        $MataKuliah->update($request->validated());
        return (new MataKuliahResource($MataKuliah))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MataKuliah $MataKuliah
     * @return Response
     * @throws Exception
     */
    public function destroy(MataKuliah $MataKuliah): Response
    {
        $MataKuliah->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
