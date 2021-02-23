<?php

namespace App\Http\Controllers\Api\V1\JasaPrint;

use App\Http\Controllers\Controller;
use App\Http\Requests\JasaPrintRequest;
use App\Http\Resources\JasaPrintResource;
use App\JasaPrint;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class JasaPrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JasaPrintResource
     */
    public function index(): JasaPrintResource
    {
        return new JasaPrintResource(JasaPrint::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param JasaPrintRequest $request
     * @return JsonResponse|Response|object
     */
    public function store(JasaPrintRequest $request)
    {
        $jasaprint = JasaPrint::create($request->validated());
        return (new JasaPrintResource($jasaprint))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param JasaPrint $JasaPrint
     * @return JasaPrintResource
     */
    public function show(JasaPrint $JasaPrint): JasaPrintResource
    {
        return new JasaPrintResource($JasaPrint);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param JasaPrintRequest $request
     * @param JasaPrint $JasaPrint
     * @return JsonResponse|Response|object
     */
    public function update(JasaPrintRequest $request, JasaPrint $JasaPrint)
    {
        $JasaPrint->update($request->all());
        return (new JasaPrintResource($JasaPrint))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param JasaPrint $JasaPrint
     * @return Response
     * @throws Exception
     */
    public function destroy(JasaPrint $JasaPrint): Response
    {
        $this->authorize('delete-data');
        $JasaPrint->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
