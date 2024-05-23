@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light mb-5">Cadastro de Tipo de Produto</h1>
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
                @if (!$productType)
                    <form action="/product_types/store" method="post">
                @else
                    <form action="/product_types/update/{{$productType->getId()}}" method="post">
                @endif
                    <div class="col">
                        <div data-mdb-input-init class="form-outline form-white mb-4">
                            <label class="form-label" for="typeName">Nome</label>
                            <input name="name" type="text" id="typeName" class="form-control form-control-lg" required
                                   @if ($productType)
                                   value="{{$productType->getName()}}"
                                   @endif
                            />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg">Salvar</button>
                </form>
            </div>
        </div>
    </section>
</main>