<?php

namespace App\Http\Controllers\Api\V1\Lab;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabRequest;
use App\Http\Resources\LabResource;
use App\Lab;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return LabResource
     */
    public function index(): LabResource
    {
        return new LabResource(Lab::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LabRequest $request
     * @return JsonResponse|Response|object
     */
    public function store(LabRequest $request)
    {
        $lab = Lab::create($request->validated());
        return (new LabResource($lab))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Lab $Lab
     * @return LabResource
     */
    public function show(Lab $Lab): LabResource
    {
        return new LabResource($Lab);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LabRequest $request
     * @param Lab $Lab
     * @return JsonResponse|Response|object
     */
    public function update(LabRequest $request, Lab $Lab)
    {
        $Lab->update($request->validated());
        return (new LabResource($Lab))->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Lab $Lab
     * @return Response
     * @throws Exception
     */
    public function destroy(Lab $Lab): Response
    {
        $this->authorize('delete-data');
        $Lab->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
