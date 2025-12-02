<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\DeviceTypeModel;
use CodeIgniter\API\ResponseTrait;

class DeviceTypeApiController extends BaseController
{
    use ResponseTrait;

    protected $model;

    public function __construct()
    {
        $this->model = new DeviceTypeModel();
    }

    /**
     * GET /api/device-types
     * Ambil semua device types (untuk dropdown)
     */
    public function index()
    {
        $deviceTypes = $this->model->findAll();
        
        return $this->respond([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $deviceTypes
        ], 200);
    }

    /**
     * GET /api/device-types/{id}
     * Ambil device type berdasarkan ID
     */
    public function show($id = null)
    {
        $deviceType = $this->model->find($id);
        
        if (!$deviceType) {
            return $this->failNotFound('Device type tidak ditemukan');
        }

        return $this->respond([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $deviceType
        ], 200);
    }
}