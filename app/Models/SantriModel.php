<?php

namespace App\Models;

use CodeIgniter\Model;

class SantriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'santri';
    protected $primaryKey       = 'NIS';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['NIS', 'nama_santri', 'tmpt_lahir', 'tgl_lahir', 'alamat', 'asrama', 'nama_ayah', 'nama_ibu'];

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
