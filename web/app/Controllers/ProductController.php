<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Core\Redirect;
use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Core\View;
use DesafioSoftExpert\Repositories\ProductRepository;
use DesafioSoftExpert\Repositories\ProductTypeRepository;
use DesafioSoftExpert\Requests\ProductRequest;

class ProductController extends Controller
{
    private ProductRepository $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $products = $this->productRepository->all();
        return View::render('product/index', ['products' => $products]);
    }

    public function create()
    {
        $productTypes = (new ProductTypeRepository())->all();
        return View::render('product/create', ['productTypes' => $productTypes]);
    }

    public function store(Request $request)
    {
        $isValid = (new ProductRequest($request))->validate();
        if ($isValid === true) {
            $result = $this->productRepository->create($request->getPostVars());
            if ($result) {
                Redirect::to('/products');
            } else {
                $errors = ['error' => ['Erro ao criar o registro!' => 0]];
                Redirect::to('/products/new', $errors);
            }
        } else {
            Redirect::to('/products/new', $isValid);
        }

    }

    public function show($id)
    {
        $product = $this->productRepository->find($id);
        if ($product === false) {
            Redirect::to('/products');
        }
        return View::render('product/show', ['product' => $product]);
    }

    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        $productTypes = (new ProductTypeRepository())->all();
        if ($product === false) {
            Redirect::to('/products');
        }
        return View::render('product/edit', ['product' => $product, 'productTypes' => $productTypes]);
    }

    public function update($id, Request $request)
    {
        $isValid = (new ProductRequest($request))->validate();
        if ($isValid === true) {
            $repository = new ProductRepository();
            $product = $repository->find($id);
            if ($product === false) {
                Redirect::to('/products');
            }
            $product = $repository->update($id, $request->getPostVars());
            if ($product === false) {
                Redirect::to('/products/edit/' . $id);
            }
            Redirect::to('/products');
        } else {
            Redirect::to('/products/edit/' . $id, $isValid);
        }
    }

    public function destroy($id)
    {
        $product = $this->productRepository->delete($id);
        if ($product === false) {
            $errors = ['error' => ['Não foi possível remover o registro!' => 0]];
            Redirect::to('/products', $errors);
        }
        Redirect::to('/products');
    }
}