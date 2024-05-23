@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-9 col-md-8 mx-auto">
                <h1 class="fw-light">Listagem de Tipos de Produto</h1>
                <a type="button" class="btn btn-primary" href="/product_types/new">
                    <i class="bi bi-tags"></i>
                    Adicionar
                </a>

                <div class="mt-5">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th>Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($productTypes as $productType)
                        <tr>
                            <td>{{$productType->getId()}}</td>
                            <td>{{$productType->getName()}}</td>
                            <td>
                                <div class="row align-items-center">
                                    <div class="col">
                                        <a class="" href="/product_types/edit/{{$productType->getId()}}"><i class="bi bi-pencil"></i></a>
                                    </div>
                                    <div class="col">
                                        <form action="/product_types/destroy/{{$productType->getId()}}" method="post">
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