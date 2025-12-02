<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\DeviceModel;
use App\Models\DeviceTypeModel;
use CodeIgniter\API\ResponseTrait;

class DeviceApiController extends BaseController
{
    use ResponseTrait;

    protected $model;

    public function __construct()
    {
        $this->model = new DeviceModel();
    }

    /**
     * GET /api/devices
     * Ambil semua devices
     */
    public function index()
    {
        $devices = $this->model->getAllWithType();
        
        return $this->respond([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $devices
        ], 200);
    }

    /**
     * GET /api/devices/{id}
     * Ambil device berdasarkan ID
     */
    public function show($id = null)
    {
        $device = $this->model->getWithType($id);
        
        if (!$device) {
            return $this->failNotFound('Device tidak ditemukan');
        }

        return $this->respond([
            'status' => 'success',
            'message' => 'Data berhasil diambil',
            'data' => $device
        ], 200);
    }

    /**
     * POST /api/devices
     * Buat device baru
     */
    public function create()
    {
        $data = [
            'device_type_id' => $this->request->getJSON(true)['device_type_id'] ?? null,
            'name' => $this->request->getJSON(true)['name'] ?? null,
            'specification' => $this->request->getJSON(true)['specification'] ?? null,
            'status' => $this->request->getJSON(true)['status'] ?? 'active',
        ];

        if (!$this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $device = $this->model->getWithType($this->model->getInsertID());

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Device berhasil ditambahkan',
            'data' => $device
        ]);
    }

    /**
     * PUT /api/devices/{id}
     * Update device
     */
    public function update($id = null)
    {
        $device = $this->model->find($id);
        
        if (!$device) {
            return $this->failNotFound('Device tidak ditemukan');
        }

        $data = [
            'device_type_id' => $this->request->getJSON(true)['device_type_id'] ?? $device['device_type_id'],
            'name' => $this->request->getJSON(true)['name'] ?? $device['name'],
            'specification' => $this->request->getJSON(true)['specification'] ?? $device['specification'],
            'status' => $this->request->getJSON(true)['status'] ?? $device['status'],
        ];

        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        $updatedDevice = $this->model->getWithType($id);

        return $this->respond([
            'status' => 'success',
            'message' => 'Device berhasil diupdate',
            'data' => $updatedDevice
        ], 200);
    }

    /**
     * DELETE /api/devices/{id}
     * Hapus device
     */
    public function delete($id = null)
    {
        $device = $this->model->find($id);
        
        if (!$device) {
            return $this->failNotFound('Device tidak ditemukan');
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            'status' => 'success',
            'message' => 'Device berhasil dihapus'
        ]);
    }
}