<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Core\Redirect;
use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Core\View;
use DesafioSoftExpert\Repositories\ProductTypeRepository;
use DesafioSoftExpert\Requests\ProductTypeRequest;

class ProductTypeController extends Controller
{
    private ProductTypeRepository $productTypeRepository;

    /**
     * @param ProductTypeRepository $productTypeRepository
     */
    public function __construct(ProductTypeRepository $productTypeRepository)
    {
        $this->productTypeRepository = $productTypeRepository;
    }

    public function index()
    {
        $productTypes = $this->productTypeRepository->all();
        return View::render('product_type/index', ['productTypes' => $productTypes]);
    }

    public function create()
    {
        return View::render('product_type/create');
    }

    public function store(Request $request)
    {
        $isValid = (new ProductTypeRequest($request))->validate();
        if ($isValid === true) {
            $result = $this->productTypeRepository->create($request->getPostVars());
            if ($result) {
                Redirect::to('/product_types');
            } else {
                $errors = ['error' => ['Erro ao criar o registro!' => 0]];
                Redirect::to('/product_types/new', $errors);
            }
        } else {
            Redirect::to('/product_types/new', $isValid);
        }
    }

    public function edit($id)
    {
        $productType = $this->productTypeRepository->find($id);
        if ($productType === false) {
            Redirect::to('/product_type');
        }
        return View::render('product_type/create', ['productType' => $productType]);
    }

    public function update($id, Request $request)
    {
        $isValid = (new ProductTypeRequest($request))->validate();
        if ($isValid === true) {
            $repository = new ProductTypeRepository();
            $productType = $repository->find($id);
            if ($productType === false) {
                Redirect::to('/product_type');
            }
            $productType = $repository->update($id, $request->getPostVars());
            if ($productType === false) {
                Redirect::to('/product_types/edit/' . $id);
            }
            Redirect::to('/product_types');
        } else {
            Redirect::to('/product_types/new', $isValid);
        }
    }

    public function destroy($id)
    {
        $productType = $this->productTypeRepository->delete($id);
        if ($productType === false) {
            $errors = ['error' => ['Não foi possível remover o registro!' => 0]];
            Redirect::to('/product_types', $errors);
        }
        Redirect::to('/product_types');
    }
}