@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light mb-5">Cadastro de Produto</h1>
            </div>

            <div class="my-5">
                <form action="/products/store" method="post">
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <label class="form-label" for="typeName">Produto</label>
                                <input name="name" type="text" id="typeName" class="form-control form-control-lg" required/>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="priceInput">Preço</label>
                                <input name="price" type="text" id="priceInput" class="form-control form-control-lg" step="0.01" min="0" max="10" required/>
                            </div>
                        </div>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="formDesc">Descrição</label>
                        <textarea name="description" id="formDesc" class="form-control" rows="4" required></textarea>
                    </div>

                    <select name="product_type" class="form-select form-select-lg mb-4" aria-label="Default select example" required>
                        <option selected>Open this select menu</option>
                        @foreach ($productTypes as $productType)
                        <option value="{{$productType->getId()}}">{{$productType->getName()}}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-success btn-lg">Salvar</button>
                </form>
            </div>
        </div>
        </div>
    </section>
</main>