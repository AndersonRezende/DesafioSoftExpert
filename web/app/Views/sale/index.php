@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-9 col-md-8 mx-auto">
                <h1 class="fw-light">Listagem de Vendas</h1>
                <a type="button" class="btn btn-primary" href="/sales/new">
                    <i class="bi bi-cart"></i>
                    Nova Venda
                </a>

                <div class="mt-5">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Total sem impostos</th>
                            <th scope="col">Total com impostos</th>
                            <th scope="col">Quantidade de itens</th>
                            <th scope="col">Finalizado</th>
                            <th scope="col">Operações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sales as $sale)
                        <tr>
                            <td>{{$sale->getId()}}</td>
                            <td>R$ {{number_format($sale->getTotalBaseValue(), 2)}}</td>
                            <td>R$ {{number_format($sale->getTotalValueWithTax(), 2)}}</td>
                            <td>{{$sale->getItemsCount()}}</td>
                            <td>{{$sale->getFinished()}}</td>

                            <td>
                                <div class="row align-items-center">
                                    <div class="col">
                                        <a class="" href="/sales/{{$sale->getId()}}"><i class="bi bi-eye"></i></a>
                                    </div>
                                    <div class="col">
                                        <form action="/sales/destroy/{{$sale->getId()}}" method="post">
                                            <button class="btn btn-link text-danger" type="submit">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>