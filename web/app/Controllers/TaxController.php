<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Core\Redirect;
use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Core\View;
use DesafioSoftExpert\Repositories\TaxRepository;
use DesafioSoftExpert\Repositories\ProductTypeRepository;
use DesafioSoftExpert\Requests\TaxRequest;

class TaxController extends Controller
{
    private TaxRepository $taxRepository;
    private ProductTypeRepository $productTypeRepository;

    /**
     * @param TaxRepository $taxRepository
     * @param ProductTypeRepository $productTypeRepository
     */
    public function __construct(TaxRepository $taxRepository, ProductTypeRepository $productTypeRepository)
    {
        $this->taxRepository = $taxRepository;
        $this->productTypeRepository = $productTypeRepository;
    }

    public function index()
    {
        $taxes = $this->taxRepository->all();
        return View::render('product_type_tax/index', ['taxes' => $taxes]);
    }

    public function create(Request $request)
    {
        $productTypes = $this->productTypeRepository->all();
        $errors = $request->get('error');
        return View::render('product_type_tax/create', ['productTypes' => $productTypes, 'errors' => $errors]);
    }

    public function store(Request $request)
    {
        $isValid = (new TaxRequest($request))->validate();
        if ($isValid === true) {
            $result = $this->taxRepository->create($request->getPostVars());
            if ($result) {
                Redirect::to('/tax');
            } else {
                $errors = ['error' => ['Erro ao criar o registro!' => 0]];
                Redirect::to('/tax/new', $errors);
            }
        } else {
            Redirect::to('/tax/new', $isValid);
        }
    }

    public function show($id)
    {
        $tax = $this->taxRepository->find($id);
        if ($tax === false) {
            Redirect::to('/tax');
        }
        return View::render('product_type_tax/show', ['tax' => $tax]);
    }

    public function edit($id, Request $request)
    {
        $tax = $this->taxRepository->find($id);
        $productTypes = $this->productTypeRepository->all();
        $errors = $request->get('error');
        if ($tax === false) {
            Redirect::to('/tax');
        }
        return View::render('product_type_tax/edit', ['tax' => $tax, 'productTypes' => $productTypes, 'errors' => $errors]);
    }

    public function update($id, Request $request)
    {
        $isValid = (new TaxRequest($request))->validate();
        if ($isValid === true) {
            $tax = $this->taxRepository->find($id);
            if ($tax === false) {
                Redirect::to('/tax');
            }
            $tax = $this->taxRepository->update($id, $request->getPostVars());
            if ($tax === false) {
                Redirect::to('/tax/edit/' . $id);
            }
            Redirect::to('/tax');
        } else {
            Redirect::to('/tax/edit/' . $id, $isValid);
        }
    }

    public function destroy($id)
    {
        $tax = $this->taxRepository->delete($id);
        if ($tax === false) {
            $errors = ['error' => ['Não foi possível remover o registro!' => 0]];
            Redirect::to('/tax', $errors);
        }
        Redirect::to('/tax');
    }
}