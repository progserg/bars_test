<?php

namespace App\Controllers;

use App\Models\SupplyModel;
use App\Models\ProviderModel;
use App\Models\ProductModel;

class SupplyController extends BaseController
{
    public function __construct(array $_params = [])
    {
        parent::__construct($_params);
        $this->model = new SupplyModel();
    }

    public function indexAction()
    {
        $products = new ProductModel();
        $providers = new ProviderModel();

        echo \App\Views\View::render('supplies', [
            'title' => 'Форма поставок',
            'products' => $products->getAll(),
            'providers' => $providers->getAll(),
            'supplies' => $this->model->getAll()
        ]);
        return true;
    }

    public function searchAction()
    {
        $products = new ProductModel();
        $providers = new ProviderModel();

        $productId = (int)$this->_params['productId'];
        $providerId = (int)$this->_params['providerId'];
        $dateStart = $this->_params['date'];
        $customer = trim($this->_params['customer']);

        if (date_parse($dateStart)['error_count'] > 0) {
            $dateStart = '1000-01-01 00:00:00';
            $dateEnd = '1000-01-01 00:00:00';
        } else {
            $dateStart = $dateStart . ' 00:00:00';
            $dateStartObj = new \DateTime($dateStart);
            $dateEnd = new \DateTime($dateStartObj->format('Y') . '-' . $dateStartObj->format('m') . '-' . $dateStartObj->format('d') . ' 23:59:59');
            $dateEnd = $dateEnd->format('Y-m-d H:i:s');
        }

        $result = [
            'status' => 'success',
            'msg' => 'Успешно выполнено',
            'data' => \App\Views\View::render('supply', [
                'products' => $products->getAll(),
                'providers' => $providers->getAll(),
                'supplies' => $this->model->search($productId, $providerId, $dateStart, $dateEnd, $customer)
            ]),
        ];
        echo json_encode($result);
        return true;
    }

    public function saveAction()
    {
        $result = [
            'status' => 'error',
            'msg' => 'Ошибка'
        ];
        if ($this->model->save(
            $this->_params['supplyId'], $this->_params['providerId'],
            $this->_params['productId'], $this->_params['quantity'],
            $this->_params['customer'])) {
            $result = [
                'status' => 'success',
                'msg' => 'Успешно выполнено'
            ];
        }
        echo json_encode($result);
        return true;

    }

    public function deleteAction()
    {
        $result = [
            'status' => 'error',
            'msg' => 'Ошибка'
        ];
        if ($this->model->delete($this->_params['supplyId'])) {
            $result = [
                'status' => 'success',
                'msg' => 'Успешно выполнено'
            ];
        }
        echo json_encode($result);
        return true;

    }

    public function addAction()
    {
        $result = [
            'status' => 'error',
            'msg' => 'Ошибка'
        ];

        if ($supply = $this->model->add($this->_params['providerId'], $this->_params['productId'],
            $this->_params['quantity'], $this->_params['customer'])) {

            $products = new ProductModel();
            $providers = new ProviderModel();
            $result = [
                'status' => 'success',
                'msg' => 'Успешно выполнено',
                'data' => \App\Views\View::render('supply', [
                    'supplies' => $supply,
                    'products' => $products->getAll(),
                    'providers' => $providers->getAll(),
                ]),
            ];
        }
        echo json_encode($result);
        return true;

    }
}