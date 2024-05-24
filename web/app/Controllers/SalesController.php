<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Core\Redirect;
use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Core\View;
use DesafioSoftExpert\Repositories\ProductRepository;
use DesafioSoftExpert\Repositories\ProductTypeRepository;
use DesafioSoftExpert\Repositories\SaleRepository;
use DesafioSoftExpert\Requests\ProductRequest;
use DesafioSoftExpert\Requests\SaleRequest;
use DesafioSoftExpert\Service\SaleService;

class SalesController extends Controller
{
    public function index()
    {
        $sales = (new SaleRepository())->all();
        return View::render('sale/index', ['sales' => $sales]);
    }

    public function create()
    {
        $products = (new ProductRepository())->all();
        return View::render('sale/create', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $isValid = (new SaleRequest($request))->validate();
        if ($isValid === true) {
            $result = (new SaleService())->buildSale($request->getPostVars());
            if ($result === true) {
                Redirect::to('/sales');
            } else {
                $errors = ['error' => [$result => 0]];
                Redirect::to('/sales/new', $errors);
            }
        } else {
            Redirect::to('/sales/new', $isValid);
        }

    }

    public function show($id)
    {
        $product = (new ProductRepository())->find($id);
        if ($product === false) {
            Redirect::to('/sales');
        }
        return View::render('sale/show', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = (new ProductRepository())->find($id);
        $productTypes = (new ProductTypeRepository())->all();
        if ($product === false) {
            Redirect::to('/sales');
        }
        return View::render('sale/edit', ['product' => $product, 'productTypes' => $productTypes]);
    }

    public function update($id, Request $request)
    {
        $isValid = (new ProductRequest($request))->validate();
        if ($isValid === true) {
            $repository = new ProductRepository();
            $product = $repository->find($id);
            if ($product === false) {
                Redirect::to('/sales');
            }
            $product = $repository->update($id, $request->getPostVars());
            if ($product === false) {
                Redirect::to('/sales/edit/' . $id);
            }
            Redirect::to('/sales');
        } else {
            Redirect::to('/sales/edit/' . $id, $isValid);
        }
    }

    public function destroy($id)
    {
        $product = (new ProductRepository())->delete($id);
        if ($product === false) {
            $errors = ['error' => ['Não foi possível remover o registro!' => 0]];
            Redirect::to('/sales', $errors);
        }
        Redirect::to('/sales');
    }
}