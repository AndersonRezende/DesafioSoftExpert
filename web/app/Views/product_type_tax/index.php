@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-9 col-md-8 mx-auto">
                <h1 class="fw-light">Listagem de Impostos de Tipos</h1>
                <a type="button" class="btn btn-primary" href="/tax/new">
                    <i class="bi bi-box-seam"></i>
                    Adicionar
                </a>

                <div class="mt-5">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Tipo de Produto</th>
                            <th scope="col">Valor %</th>
                            <th scope="col">Operações</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($taxes as $tax)
                        <tr>
                            <td>{{$tax->getId()}}</td>
                            <td><a href="/tax/{{$tax->getId()}}">{{$tax->getName()}}</a></td>
                            <td>
                                {{$tax->productTypesList()}}
                            </td>
                            <td>{{number_format($tax->getValue(), 2)}}%</td>
                            <td>
                                <div class="row align-items-center">
                                    <div class="col">
                                        <a class="" href="/tax/edit/{{$tax->getId()}}"><i class="bi bi-pencil"></i></a>
                                    </div>
                                    <div class="col">
                                        <form action="/tax/destroy/{{$tax->getId()}}" method="post">
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