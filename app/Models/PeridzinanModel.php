<?php

namespace App\Models;

use CodeIgniter\Model;

class PeridzinanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'peridzinan';
    protected $primaryKey       = 'tanggal';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['tanggal', 'kd_petugas', 'NIS', 'lama', 'alasan', 'tujuan'];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    
    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password'])) {
            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }
}
