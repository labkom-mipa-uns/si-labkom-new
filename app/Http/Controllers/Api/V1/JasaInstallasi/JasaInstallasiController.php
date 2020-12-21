<?php

namespace App\Http\Controllers\Api\V1\JasaInstallasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\JasaInstallasiRequest;
use App\Http\Resources\JasaInstallasiResource;
use App\JasaInstallasi;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JasaInstallasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JasaInstallasiResource
     */
    public function index(): JasaInstallasiResource
    {
        return new JasaInstallasiResource(JasaInstallasi::with(['mahasiswa', 'software'])->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JasaInstallasiRequest $request
     * @return JsonResponse|Response|object
     */
    public function store(JasaInstallasiRequest $request)
    {
        $jasainstallasi = JasaInstallasi::create($request->validated());
        return (new JasaInstallasiResource($jasainstallasi))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param JasaInstallasi $JasaInstallasi
     * @return JasaInstallasiResource
     */
    public function show(JasaInstallasi $JasaInstallasi): JasaInstallasiResource
    {
        return new JasaInstallasiResource($JasaInstallasi::with(['mahasiswa', 'software'])->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JasaInstallasiRequest $request
     * @param JasaInstallasi $JasaInstallasi
     * @return JsonResponse|Response|object
     */
    public function update(JasaInstallasiRequest $request, JasaInstallasi $JasaInstallasi)
    {
        $JasaInstallasi->update($request->all());
        return (new JasaInstallasiResource($JasaInstallasi))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JasaInstallasi $JasaInstallasi
     * @return Response
     * @throws Exception
     */
    public function destroy(JasaInstallasi $JasaInstallasi): Response
    {
        $this->authorize('delete-data');
        $JasaInstallasi->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
