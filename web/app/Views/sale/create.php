@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light mb-5">Nova Venda</h1>
            </div>

            @if ($errors)
            <div class="alert alert-danger" role="alert">
                Ocorreu um erro ao validar o(s) seguinte(s) campo(s): <br>
                @foreach ($errors as $key => $error)
                {{ ucfirst($key) }}
                @endforeach
            </div>
            @endif

            <div class="my-5">
                <div class="row">

                    <form action="/sales/store" method="post">
                        @foreach($products as $product)
                        <div class="col-12">
                            <div class="row gx-4 gx-lg-5 align-items-center mb-5">
                                <div class="col-md-6">
                                    <img class="card-img-top mb-5 mb-md-0" src="data:image/jpeg;base64,{{$product->getImage()}}" alt="{{$product->getName()}}" style="width: 20rem;">
                                </div>
                                <div class="col-md-6">
                                    <div class="small mb-1">SKU: {{$product->getSku()}}</div>
                                    <h1 class="display-5 fw-bolder">{{$product->getName()}}</h1>
                                    <div class="small mb-1">{{$product->getProductType()->getName()}}</div>
                                    <div class="fs-5">Preço base:
                                        <span>{{$product->formattedMoney($product->getPrice())}}</span>
                                    </div>
                                    <div class="fs-5 mb-5">Preço com impostos:
                                        <span>{{$product->formattedMoney($product->getPriceWithTaxes())}}</span>
                                    </div>
                                    <p class="lead">{{$product->getDescription()}}</p>
                                    <div class="d-flex justify-content-center">
                                        <div class="btn-group me-3" role="group" aria-label="Basic mixed styles example">
                                            <button id="decrease{{$product->getId()}}" type="button" class="btn btn-danger"><i class="bi bi-dash"></i></button>
                                            <input name="{{$product->getId()}}" class="form-control text-center" id="inputQuantity{{$product->getId()}}" type="number" value="0" style="max-width: 3rem">
                                            <button id="increase{{$product->getId()}}" type="button" class="btn btn-success"><i class="bi bi-plus"></i></button>
                                        </div>
                                        <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                            <i class="bi-cart-fill me-1"></i>
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="col-12">
                            <button class="btn btn-success" type="submit">Avançar</button>
                        </div>
                        <!--<div class="floating-div" id="floatingDiv">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-primary">Seu carrinho</span>
                                <span class="badge bg-primary rounded-pill" id="pillQty">0</span>
                            </h4>
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">Product name</h6>
                                        <small class="text-body-secondary">Brief description</small>
                                    </div>
                                    <span class="text-body-secondary">$12</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">Second product</h6>
                                        <small class="text-body-secondary">Brief description</small>
                                    </div>
                                    <span class="text-body-secondary">$8</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-sm">
                                    <div>
                                        <h6 class="my-0">Third item</h6>
                                        <small class="text-body-secondary">Brief description</small>
                                    </div>
                                    <span class="text-body-secondary">$5</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                                    <div class="text-success">
                                        <h6 class="my-0">Promo code</h6>
                                        <small>EXAMPLECODE</small>
                                    </div>
                                    <span class="text-success">−$5</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Total (USD)</span>
                                    <strong>$20</strong>
                                </li>
                            </ul>

                            <form class="card p-2">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Promo code">
                                    <button type="submit" class="btn btn-secondary">Redeem</button>
                                </div>
                            </form>
                        </div>-->
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="../quantity.js"></script>
    <script src="../floatingdiv.js"></script>
</main>