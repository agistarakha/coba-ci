<?php

namespace App\Controllers;

use App\Models\DeviceModel;
use App\Models\DeviceTypeModel;
use App\Models\TenantModel;
use CodeIgniter\RESTful\ResourceController;

class DeviceController extends ResourceController
{
    protected $modelName = DeviceModel::class;
    protected $format    = 'json';

    /**
     * Menampilkan semua devices
     */
    public function index()
    {
        $model = new DeviceModel();
        $data = [
            'title' => 'Devices',
            'devices' => $model->getAllWithType(),
        ];
        return view('devices/index', $data);
    }

    /**
     * Menampilkan form create
     */
    public function new()
    {
        $deviceTypeModel = new DeviceTypeModel();
        $tenantModel = new TenantModel();
        $data = [
            'title' => 'Tambah Device',
            'deviceTypes' => $deviceTypeModel->findAll(),
            'tenants' => $tenantModel->findAll(),
        ];
        return view('devices/create', $data);
    }

    /**
     * Menyimpan device baru
     */
    public function create()
    {
        $model = new DeviceModel();
        
        $data = [
            'device_type_id' => $this->request->getPost('device_type_id'),
            'tenant_id' => $this->request->getPost('tenant_id'),
            'name' => $this->request->getPost('name'),
            'specification' => $this->request->getPost('specification'),
            'status' => $this->request->getPost('status'),
        ];

        if (!$model->insert($data)) {
            return redirect()->back()
                ->with('errors', $model->errors())
                ->withInput();
        }

        return redirect()->to('/devices')
            ->with('success', 'Device berhasil ditambahkan');
    }

    /**
     * Menampilkan detail device
     */
    public function show($id = null)
    {
        $model = new DeviceModel();
        $device = $model->getWithType($id);
        
        if (!$device) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Detail Device',
            'device' => $device,
        ];
        return view('devices/show', $data);
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id = null)
    {
        $model = new DeviceModel();
        $device = $model->find($id);
        
        if (!$device) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $deviceTypeModel = new DeviceTypeModel();
        $tenantModel = new TenantModel();
        $data = [
            'title' => 'Edit Device',
            'device' => $device,
            'deviceTypes' => $deviceTypeModel->findAll(),
            'tenants' => $tenantModel->findAll(),
        ];
        return view('devices/edit', $data);
    }

    /**
     * Update device
     */
    public function update($id = null)
    {
        $model = new DeviceModel();
        $device = $model->find($id);
        
        if (!$device) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'device_type_id' => $this->request->getPost('device_type_id'),
            'tenant_id' => $this->request->getPost('tenant_id'),
            'name' => $this->request->getPost('name'),
            'specification' => $this->request->getPost('specification'),
            'status' => $this->request->getPost('status'),
        ];

        if (!$model->update($id, $data)) {
            return redirect()->back()
                ->with('errors', $model->errors())
                ->withInput();
        }

        return redirect()->to('/devices')
            ->with('success', 'Device berhasil diupdate');
    }

    /**
     * Hapus device
     */
    public function delete($id = null)
    {
        $model = new DeviceModel();
        $device = $model->find($id);
        
        if (!$device) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $model->delete($id);
        return redirect()->to('/devices')
            ->with('success', 'Device berhasil dihapus');
    }
}