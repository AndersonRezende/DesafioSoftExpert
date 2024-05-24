@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light mb-5">Imposto</h1>
            </div>

            <div class="my-5">
                <div class="row d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$tax->getName()}}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <p>Tipos de produtos aplicáveis:</p>
                                {{$tax->productTypesList()}}
                            </li>
                            <li class="list-group-item">Percentual: {{number_format($tax->getValue(), 2)}}%</li>
                        </ul>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a class="card-link" href="/tax/edit/{{$tax->getId()}}"><i class="bi bi-pencil"> Editar</i></a>
                                </div>
                                <div class="col">
                                    <form action="/tax/destroy/{{$tax->getId()}}" method="post">
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