@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-9 col-md-8 mx-auto">
                <h1 class="fw-light">Listagem de Produtos</h1>
                <a type="button" class="btn btn-primary" href="/products/new">
                    <i class="bi bi-box-seam"></i>
                    Adicionar
                </a>

                <div class="mt-5">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Operações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$product->getId()}}</td>
                            <td><a href="/products/{{$product->getId()}}">{{$product->getName()}}</a></td>
                            <td>{{$product->getPrice()}}</td>
                            <td>{{$product->getProductType()->getName()}}</td>
                            <td>
                                <div class="row align-items-center">
                                    <div class="col">
                                        <a class="" href="/products/edit/{{$product->getId()}}"><i class="bi bi-pencil"></i></a>
                                    </div>
                                    <div class="col">
                                        <form action="/products/destroy/{{$product->getId()}}" method="post">
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