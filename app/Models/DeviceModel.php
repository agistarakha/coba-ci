<?php

namespace App\Models;

use CodeIgniter\Model;

class DeviceModel extends Model
{
    protected $table            = 'devices';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['device_type_id', 'name', 'specification', 'status'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'device_type_id' => 'required|integer',
        'name' => 'required|min_length[3]|max_length[100]',
        'status' => 'required|in_list[active,inactive,maintenance]',
    ];
    protected $validationMessages   = [
        'device_type_id' => [
            'required' => 'Device type wajib dipilih',
            'integer' => 'Device type harus berupa angka',
        ],
        'name' => [
            'required' => 'Nama device wajib diisi',
            'min_length' => 'Nama minimal 3 karakter',
            'max_length' => 'Nama maksimal 100 karakter',
        ],
        'status' => [
            'required' => 'Status wajib dipilih',
            'in_list' => 'Status tidak valid',
        ],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    /**
     * Ambil semua devices dengan relasi device type
     */
    public function getAllWithType()
    {
        return $this->select('devices.*, device_types.name as device_type_name')
                    ->join('device_types', 'device_types.id = devices.device_type_id')
                    ->findAll();
    }

    /**
     * Ambil device dengan relasi device type
     */
    public function getWithType($id)
    {
        return $this->select('devices.*, device_types.name as device_type_name')
                    ->join('device_types', 'device_types.id = devices.device_type_id')
                    ->find($id);
    }
}