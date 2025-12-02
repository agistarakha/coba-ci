<?php

namespace App\Models;

use CodeIgniter\Model;

class DeviceTypeModel extends Model
{
    protected $table            = 'device_types';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'name' => 'required|min_length[3]|max_length[100]',
    ];
    protected $validationMessages   = [
        'name' => [
            'required' => 'Nama device type wajib diisi',
            'min_length' => 'Nama minimal 3 karakter',
            'max_length' => 'Nama maksimal 100 karakter',
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
}