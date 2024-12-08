<?php
require_once __DIR__ . '/../layer_data_access/UserModel.php';

class UserController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function listUsers()
    {
        return $this->model->getAllUsers();
    }

    public function viewUser($id)
    {
        return $this->model->getUserByproduct_id($id);
    }

    public function updateUser($username, $email, $phone, $full_name, $role)
    {
        return $this->model->updateUser($username, $email, $phone, $full_name, $role);
    }

    public function deleteUser($id)
    {
        return $this->model->deleteUser($id);
    }
}
