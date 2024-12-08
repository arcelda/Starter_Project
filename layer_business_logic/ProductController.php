<?php
require_once __DIR__ . '/../layer_data_access/ProductModel.php';

class ProductController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    public function listProducts()
    {
        return $this->model->getAllProducts();
    }

    public function viewProduct($product_id)
    {
        return $this->model->getProductByproduct_id($product_id);
    }

    public function addProduct($name, $price, $description)
    {
        return $this->model->createProduct($name, $price, $description);
    }

    public function updateProduct($product_id, $name, $price, $description)
    {
        return $this->model->updateProduct($product_id, $name, $price, $description);
    }

    public function deleteProduct($product_id)
    {
        return $this->model->deleteProduct($product_id);
    }
}
