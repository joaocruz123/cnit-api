<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateFrequenciaAPIRequest;
use App\Http\Requests\API\UpdateFrequenciaAPIRequest;
use App\Models\Frequencia;
use App\Repositories\FrequenciaRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;

/**
 * Class FrequenciaAPIController
 */
class FrequenciaAPIController extends AppBaseController
{
    private FrequenciaRepository $frequenciaRepository;

    public function __construct(FrequenciaRepository $frequenciaRepo)
    {
        $this->frequenciaRepository = $frequenciaRepo;
    }

    /**
     * Display a listing of the Frequencias.
     * GET|HEAD /frequencias
     */
    public function index(Request $request): JsonResponse
    {
        $frequencias = $this->frequenciaRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($frequencias->toArray(), 'Frequencias retrieved successfully');
    }

    /**
     * Store a newly created Frequencia in storage.
     * POST /frequencias
     */
    public function store(CreateFrequenciaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        $frequencia = $this->frequenciaRepository->create($input);

        return $this->sendResponse($frequencia->toArray(), 'Frequencia saved successfully');
    }

    /**
     * Display the specified Frequencia.
     * GET|HEAD /frequencias/{id}
     */
    public function show($id): JsonResponse
    {
        /** @var Frequencia $frequencia */
        $frequencia = $this->frequenciaRepository->find($id);

        if (empty($frequencia)) {
            return $this->sendError('Frequencia not found');
        }

        return $this->sendResponse($frequencia->toArray(), 'Frequencia retrieved successfully');
    }

    /**
     * Update the specified Frequencia in storage.
     * PUT/PATCH /frequencias/{id}
     */
    public function update($id, UpdateFrequenciaAPIRequest $request): JsonResponse
    {
        $input = $request->all();

        /** @var Frequencia $frequencia */
        $frequencia = $this->frequenciaRepository->find($id);

        if (empty($frequencia)) {
            return $this->sendError('Frequencia not found');
        }

        $frequencia = $this->frequenciaRepository->update($input, $id);

        return $this->sendResponse($frequencia->toArray(), 'Frequencia updated successfully');
    }

    /**
     * Remove the specified Frequencia from storage.
     * DELETE /frequencias/{id}
     *
     * @throws \Exception
     */
    public function destroy($id): JsonResponse
    {
        /** @var Frequencia $frequencia */
        $frequencia = $this->frequenciaRepository->find($id);

        if (empty($frequencia)) {
            return $this->sendError('Frequencia not found');
        }

        $frequencia->delete();

        return $this->sendSuccess('Frequencia deleted successfully');
    }
}
