<?php

namespace App\Controllers;

use App\Models\TenantModel;
use App\Models\DeviceModel;
use CodeIgniter\RESTful\ResourceController;

class TenantController extends ResourceController
{
    protected $modelName = TenantModel::class;
    protected $format    = 'json';

    public function index()
    {
        $model = new TenantModel();
        $data = [
            'title' => 'Tenants',
            'tenants' => $model->getAllWithDeviceCount(),
        ];
        return view('tenants/index', $data);
    }

    public function new()
    {
        $data = [
            'title' => 'Tambah Tenant',
        ];
        return view('tenants/create', $data);
    }

    public function create()
    {
        $model = new TenantModel();

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'status' => $this->request->getPost('status'),
        ];

        if (!$model->insert($data)) {
            return redirect()->back()
                ->with('errors', $model->errors())
                ->withInput();
        }

        return redirect()->to('/tenants')
            ->with('success', 'Tenant berhasil ditambahkan');
    }

    public function show($id = null)
    {
        $model = new TenantModel();
        $tenant = $model->find($id);

        if (!$tenant) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

    $deviceModel = new DeviceModel();
    $devices = $deviceModel->select('devices.*, device_types.name as device_type_name')
                   ->join('device_types', 'device_types.id = devices.device_type_id', 'left')
                   ->where('devices.tenant_id', $id)
                   ->findAll();

        $data = [
            'title' => 'Detail Tenant',
            'tenant' => $tenant,
            'devices' => $devices,
        ];
        return view('tenants/show', $data);
    }

    public function edit($id = null)
    {
        $model = new TenantModel();
        $tenant = $model->find($id);

        if (!$tenant) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'title' => 'Edit Tenant',
            'tenant' => $tenant,
        ];
        return view('tenants/edit', $data);
    }

    public function update($id = null)
    {
        $model = new TenantModel();
        $tenant = $model->find($id);

        if (!$tenant) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'status' => $this->request->getPost('status'),
        ];

        // When updating, allow same email for current record
        // adjust is_unique rule dynamically
        $model->setValidationRule('email', 'required|valid_email|is_unique[tenants.email,id,'.$id.']');

        if (!$model->update($id, $data)) {
            return redirect()->back()
                ->with('errors', $model->errors())
                ->withInput();
        }

        return redirect()->to('/tenants')
            ->with('success', 'Tenant berhasil diupdate');
    }

    public function delete($id = null)
    {
        $model = new TenantModel();
        $tenant = $model->find($id);

        if (!$tenant) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $model->delete($id);
        return redirect()->to('/tenants')
            ->with('success', 'Tenant berhasil dihapus');
    }
}
