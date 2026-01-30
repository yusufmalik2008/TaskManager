<?php
namespace App\Models;
use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table      = 'tasks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'description', 'status', 'priority'];  // ← NO user_id
    protected $useTimestamps = true;

    public function getTasks($status = null)
    {
        $builder = $this->builder();
        if ($status) $builder->where('status', $status);
        return $builder->orderBy('priority', 'DESC')->orderBy('created_at', 'DESC')->get()->getResultArray();
    }
}
