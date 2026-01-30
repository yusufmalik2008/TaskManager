<?php
namespace App\Controllers;
use App\Models\TaskModel;

class TaskController extends BaseController
{
    protected $taskModel;

    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    private function encryptDescription($description)
    {
        if (empty($description)) return '';
        $encrypter = \Config\Services::encrypter();
        $encrypted = $encrypter->encrypt($description);
        return base64_encode($encrypted);
    }

    private function decryptDescription($encryptedBase64)
    {
        if (empty($encryptedBase64)) return '';
        try {
            $encrypted = base64_decode($encryptedBase64);
            if ($encrypted === false) return '[Invalid data]';
            $encrypter = \Config\Services::encrypter();
            return $encrypter->decrypt($encrypted);
        } catch (\Exception $e) {
            return '[Cannot decrypt]';
        }
    }

    // ✅ GLOBAL TASKS - NO USER LIMITS!
  public function index()
{
    $allTasks = $this->taskModel->getTasks();
    
    $tasks = [];
    foreach ($allTasks as $task) {
        $task['description'] = $this->decryptDescription($task['description']);
        $tasks[] = $task;
    }
    
    $data = [
        'tasks' => $tasks,
        'pendingTasks' => $this->taskModel->getTasks('pending'),     // ← ARRAY!
        'inProgressTasks' => $this->taskModel->getTasks('in_progress'), // ← ARRAY!
        'completedTasks' => $this->taskModel->getTasks('completed')  // ← ARRAY!
    ];
    return view('tasks/index', $data);
}

    public function create() { 
        return view('tasks/create'); 
    }

    // ✅ NO user_id - GLOBAL tasks!
    public function store()
    {
        $data = $this->request->getPost(['title', 'description', 'status', 'priority']);
        $data['description'] = $this->encryptDescription($data['description']);
        
        if (!$this->validate([
            'title' => 'required|min_length[3]',
            'status' => 'required|in_list[pending,in_progress,completed]',
            'priority' => 'required|in_list[low,medium,high]'
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
        
        if ($this->taskModel->insert($data)) {
            return redirect()->to(site_url('tasks'))->with('success', 'Task created successfully!');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to create task.');
    }

    public function edit($id)
    {
        $task = $this->taskModel->find($id);
        if (!$task) {
            return redirect()->to(site_url('tasks'))->with('error', 'Task not found.');
        }
        
        $task['description'] = $this->decryptDescription($task['description']);
        return view('tasks/edit', ['task' => (array)$task]);
    }

  public function dashboard()
{
    $totalTasks = $this->taskModel->countAll();
    $pending = $this->taskModel->where('status', 'pending')->countAll();
    $inProgress = $this->taskModel->where('status', 'in_progress')->countAll();
    $completed = $this->taskModel->where('status', 'completed')->countAll();
    
    $recentTasks = $this->taskModel->orderBy('created_at', 'DESC')->limit(5)->findAll();
    
    // ✅ FIXED: Proper array decryption
    $decryptedRecentTasks = [];
    foreach ($recentTasks as $task) {
        $task['description'] = $this->decryptDescription($task['description']);
        $task['status'] = $task['status'] ?? 'pending';
        $decryptedRecentTasks[] = $task;
    }
    
    $data = [
        'totalTasks' => $totalTasks,
        'pendingTasks' => $pending,
        'inProgressTasks' => $inProgress,
        'completedTasks' => $completed,
        'recentTasks' => $decryptedRecentTasks,  // ✅ FIXED!
        'completionRate' => $totalTasks > 0 ? round(($completed / $totalTasks) * 100, 1) : 0
    ];
    
    return view('dashboard/index', $data);
}

    // ✅ SIMPLIFIED - GLOBAL stats
    public function account()
{
    $allTasks = $this->taskModel->getTasks();
    $decryptedTasks = [];
    foreach ($allTasks as $task) {
        $task['description'] = $this->decryptDescription($task['description']);
        $decryptedTasks[] = $task;
    }
    
    $data = [
        'tasks' => $decryptedTasks,  // ✅ For account tasks list
        'userStats' => [
            'totalTasks' => $this->taskModel->countAll(),
            'completedTasks' => $this->taskModel->where('status', 'completed')->countAll(),
            'pendingTasks' => $this->taskModel->where('status', 'pending')->countAll()
        ]
    ];
    return view('account/index', $data);
}


    public function projects()
    {
        $projects = $this->taskModel->db->table('projects')->orderBy('created_at', 'DESC')->get()->getResultArray();
        
        $data = [
            'projects' => $projects,
          //  'taskStats' => $this->taskModel->select('project_id, status, COUNT(*) as count')
            //    ->groupBy('project_id, status')->get()->getResultArray()
        ];
        return view('projects/index', $data);
    }

    public function projectsStore()
    {
        $data = $this->request->getPost(['name', 'description']);
        
        if (!$this->validate([
            'name' => 'required|min_length[3]'
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
        
        $this->taskModel->db->table('projects')->insert($data);
        return redirect()->to(site_url('projects'))->with('success', 'Project created!');
    }

    public function update($id)
    {
        $data = $this->request->getPost(['title', 'description', 'status', 'priority']);
        $data['description'] = $this->encryptDescription($data['description']);
        
        if (!$this->validate([
            'title' => 'required|min_length[3]',
            'status' => 'required|in_list[pending,in_progress,completed]',
            'priority' => 'required|in_list[low,medium,high]'
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
        
        if ($this->taskModel->update($id, $data)) {
            return redirect()->to(site_url('tasks'))->with('success', 'Task updated successfully!');
        }
        return redirect()->back()->withInput()->with('error', 'Failed to update task.');
    }

    public function delete($id)
    {
        if ($this->taskModel->delete($id)) {
            return redirect()->to(site_url('tasks'))->with('success', 'Task deleted!');
        }
        return redirect()->back()->with('error', 'Failed to delete task.');
    }
}
