@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light mb-5">Edição de Imposto</h1>
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
                <form action="/tax/update/{{$tax->getId()}}" method="post">
                    <div class="row justify-content-center mb-4">
                        <div class="col-6">
                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <label class="form-label" for="typeName">Nome</label>
                                <input name="name" type="text" id="typeName" class="form-control form-control-lg" required value="{{$tax->getName()}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-4">
                        <div class="col-6">
                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="valueInput">Percentual</label>
                                <input name="value" type="text" id="valueInput" class="form-control form-control-lg" step="0.01" min="0" max="10" required value="{{$tax->getValue()}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-4">
                        <div class="col-12">
                            <h5>Tipos de Produtos Aplicável</h5>
                        </div>
                        @foreach ($productTypes as $productType)
                        <div class="col">
                            <div class="form-check form-switch">
                                <input name="product_type[]" value="{{$productType->getId()}}" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                                       {{$tax->isCheckedProductType($productType->getName())}}
                                />
                                <label class="form-check-label" for="flexSwitchCheckDefault">{{$productType->getName()}}</label>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-success btn-lg">Salvar</button>
                </form>
            </div>
        </div>
        </div>
    </section>
</main>