<?php

namespace App\Controllers;

use App\Models\DeviceTypeModel;
use CodeIgniter\RESTful\ResourceController;

class DeviceTypeController extends ResourceController
{
    protected $modelName = DeviceTypeModel::class;
    protected $format    = 'json';

    /**
     * Menampilkan semua device types
     */
    public function index()
    {
        $model = new DeviceTypeModel();
        $data = [
            'title' => 'Device Types',
            'deviceTypes' => $model->findAll(),
        ];
        return view('device_types/index', $data);
    }

    /**
     * Menampilkan form create
     */
    public function new()
    {
        $data = [
            'title' => 'Tambah Device Type',
        ];
        return view('device_types/create', $data);
    }

    /**
     * Menyimpan device type baru
     */
    public function create()
    {
        $model = new DeviceTypeModel();
        
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        if (!$model->insert($data)) {
            return redirect()->back()
                ->with('errors', $model->errors())
                ->withInput();
        }

        return redirect()->to('/device-types')
            ->with('success', 'Device type berhasil ditambahkan');
    }

    /**
     * Menampilkan detail device type
     */
    public function show($id = null)
    {
        $model = new DeviceTypeModel();
        $deviceType = $model->find($id);
        
        if (!$deviceType) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Detail Device Type',
            'deviceType' => $deviceType,
        ];
        return view('device_types/show', $data);
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id = null)
    {
        $model = new DeviceTypeModel();
        $deviceType = $model->find($id);
        
        if (!$deviceType) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Device Type',
            'deviceType' => $deviceType,
        ];
        return view('device_types/edit', $data);
    }

    /**
     * Update device type
     */
    public function update($id = null)
    {
        $model = new DeviceTypeModel();
        $deviceType = $model->find($id);
        
        if (!$deviceType) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        if (!$model->update($id, $data)) {
            return redirect()->back()
                ->with('errors', $model->errors())
                ->withInput();
        }

        return redirect()->to('/device-types')
            ->with('success', 'Device type berhasil diupdate');
    }

    /**
     * Hapus device type
     */
    public function delete($id = null)
    {
        $model = new DeviceTypeModel();
        $deviceType = $model->find($id);
        
        if (!$deviceType) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $model->delete($id);
        return redirect()->to('/device-types')
            ->with('success', 'Device type berhasil dihapus');
    }
}