<?php

namespace App\Models;

use CodeIgniter\Model;

class TenantModel extends Model
{
    protected $table      = 'tenants';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = ['name', 'email', 'phone', 'address', 'status'];

    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[tenants.email]',
        'status' => 'required|in_list[active,inactive]',
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Nama wajib diisi',
            'min_length' => 'Nama minimal 3 karakter',
            'max_length' => 'Nama maksimal 100 karakter',
        ],
        'email' => [
            'required' => 'Email wajib diisi',
            'valid_email' => 'Email tidak valid',
            'is_unique' => 'Email sudah terdaftar',
        ],
        'status' => [
            'required' => 'Status wajib dipilih',
            'in_list' => 'Status tidak valid',
        ],
    ];

    protected $skipValidation = false;

    /**
     * Ambil semua tenant beserta jumlah device yang dimiliki
     *
     * @return array
     */
    public function getAllWithDeviceCount()
    {
        return $this->select('tenants.*, COUNT(devices.id) as device_count')
                    ->join('devices', 'devices.tenant_id = tenants.id', 'left')
                    ->groupBy('tenants.id')
                    ->findAll();
    }
}
