<?php

namespace DesafioSoftExpert\Controllers;

use DesafioSoftExpert\Core\Redirect;
use DesafioSoftExpert\Core\Request;
use DesafioSoftExpert\Core\View;
use DesafioSoftExpert\Repositories\ProductRepository;
use DesafioSoftExpert\Repositories\SaleRepository;
use DesafioSoftExpert\Requests\SaleRequest;
use DesafioSoftExpert\Service\SaleService;

class SalesController extends Controller
{
    private SaleRepository $saleRepository;
    private ProductRepository $productRepository;

    /**
     * @param SaleRepository $saleRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(SaleRepository $saleRepository, ProductRepository $productRepository)
    {
        $this->saleRepository = $saleRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        $sales = $this->saleRepository->all();
        return View::render('sale/index', ['sales' => $sales]);
    }

    public function create()
    {
        $products = $this->productRepository->all();
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
        $sale = $this->saleRepository->find($id);
        if ($sale === false) {
            Redirect::to('/sales');
        }
        return View::render('sale/show', ['sale' => $sale, 'saleProducts' => $sale->getProductsSale()]);
    }

    public function destroy($id)
    {
        $product = $this->productRepository->delete($id);
        if ($product === false) {
            $errors = ['error' => ['Não foi possível remover o registro!' => 0]];
            Redirect::to('/sales', $errors);
        }
        Redirect::to('/sales');
    }
}