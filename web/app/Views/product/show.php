@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light mb-5">Produto</h1>
            </div>

            <div class="my-5">
                <div class="row d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top py-5" alt="Imagem {{$product->getName()}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$product->getName()}}</h5>
                            <p class="card-text">{{$product->getDescription()}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$product->getProductType()->getName()}}</li>
                            <li class="list-group-item">R$ {{number_format($product->getPrice(), 2)}}</li>
                        </ul>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a class="card-link" href="/products/edit/{{$product->getId()}}"><i class="bi bi-pencil"> Editar</i></a>
                                </div>
                                <div class="col">
                                    <form action="/products/destroy/{{$product->getId()}}" method="post">
                                        <button class="btn btn-link card-link text-danger" type="submit">
                                            <i class="bi bi-trash"> Deletar</i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>