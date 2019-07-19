<?php

namespace App\Controllers;

use App\Models\ProviderModel;

class ProviderController extends BaseController
{
    public function __construct(array $_params = [])
    {
        parent::__construct($_params);
        $this->model = new ProviderModel();
    }

    public function indexAction()
    {
        $providers = $this->model->getAllWithProducts();
        $products = new \App\Models\ProductModel();

        echo \App\Views\View::render('providers', [
            'title' => 'Поставщики',
            'providers' => $providers,
            'products' => $products->getAll()
        ]);
        return true;
    }

    public function addProductsToProviderAction()
    {
        $result = [
            'status' => 'error',
            'msg' => 'Ошибка'
        ];
        if ($this->model->updateProviderProducts($this->_params['providerId'], json_decode($this->_params['selected']))) {
            $result = [
                'status' => 'success',
                'msg' => 'Успешно выполнено'
            ];
        }
        echo json_encode($result);
        return true;
    }
}