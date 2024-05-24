@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light mb-5">Venda</h1>
            </div>

            <div class="my-5">

                <div class="row mb-3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Total da compra</th>
                            <th scope="col">Total de impostos da compra</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$sale->formattedMoney($sale->getTotalBaseValue())}}</td>
                            <td>{{$sale->formattedMoney($sale->totalTax())}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    @foreach ($saleProducts as $item)
                    <div class="col-12 mb-3">
                        <div class="card shadow-sm">
                            <div class="card-head">
                                <img src="data:image/jpeg;base64,{{$item->getProduct()->getImage()}}" class="card-img-top py-5" alt="Imagem {{$item->getProduct()->getName()}}" style="width: 10rem;">
                            </div>
                            <div class="card-body">
                                <h3>{{$item->getProduct()->getName()}}</h3>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Valor total do item: {{$item->formattedMoney($item->getProductPrice() * $item->getQuantity())}}</li>
                                    <li class="list-group-item">Valor total do imposto do item: {{$item->formattedMoney($item->totalTax())}}</li>
                                </ul>
                                <p class="card-text">{{$item->getProduct()->getDescription()}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="/products/{{$item->getProduct()->getId()}}" class="btn btn-sm btn-outline-secondary">Visualizar</a>
                                    </div>
                                    <small class="text-body-secondary">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
        </div>
    </section>
</main>