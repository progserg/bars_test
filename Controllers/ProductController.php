<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController extends BaseController
{
    public function __construct(array $_params = [])
    {
        parent::__construct($_params);
        $this->model = new ProductModel();
    }

    public function indexAction()
    {
        $products = $this->model->getAllWithProviders();
        $providers = new \App\Models\ProviderModel();

        echo \App\Views\View::render('products', [
            'title' => 'Товары',
            'products' => $products,
            'providers' => $providers->getAll()
        ]);
        return true;
    }

    public function addProvidersToProductAction()
    {
        $result = [
            'status' => 'error',
            'msg' => 'Ошибка'
        ];
        if ($this->model->updateProductProviders($this->_params['productId'], json_decode($this->_params['selected']))) {
            $result = [
                'status' => 'success',
                'msg' => 'Успешно выполнено'
            ];
        }
        echo json_encode($result);
        return true;
    }
}