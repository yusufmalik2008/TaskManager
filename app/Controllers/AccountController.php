<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TaskModel;

class AccountController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $taskModel = new TaskModel();
        
        $userId = session()->get('user_id');
        $user = $userModel->find($userId);
        
        // Get user stats
        $userStats = $taskModel->getUserStats($userId);
        
        return view('account/myaccount', [
            'user' => $user,
            'userStats' => $userStats
        ]);
    }

    public function update()
    {
        $userModel = new UserModel();
        $userId = $this->request->getPost('id');
        
        $data = [
            'full_name' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($userModel->update($userId, $data)) {
            return redirect()->to('/account')->with('success', 'Profile updated successfully!');
        }

        return redirect()->back()->withInput()->with('errors', $userModel->errors());
    }
}
