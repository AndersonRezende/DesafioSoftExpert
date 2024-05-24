@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light mb-5">Edição de Produto</h1>
            </div>

            <div class="my-5">
                <form action="/products/update/{{$product->getId()}}" method="post" enctype="multipart/form-data">
                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <label class="form-label" for="typeName">Produto</label>
                                <input name="name" type="text" id="typeName" class="form-control form-control-lg" required value="{{$product->getName()}}"/>
                            </div>
                        </div>

                        <div class="col">
                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <label class="form-label" for="typeSku">SKU</label>
                                <input name="sku" type="text" id="typeSku" class="form-control form-control-lg" required value="{{$product->getSku()}}"/>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="priceInput">Preço</label>
                                <input name="price" type="text" id="priceInput" class="form-control form-control-lg" step="0.01" min="0" max="10" required value="{{$product->getPrice()}}"/>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Imagem</label>
                                <input name="image" class="form-control" type="file" id="formFile" accept="image/*">
                            </div>
                        </div>
                        <div class="col-12">
                            <img src="data:image/jpeg;base64,{{$product->getImage()}}" class="card-img-top py-5" alt="Imagem {{$product->getName()}}" style="width: 18rem;" id="preview">
                        </div>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-4">
                        <label class="form-label" for="formDesc">Descrição</label>
                        <textarea name="description" id="formDesc" class="form-control" rows="4" required>{{$product->getDescription()}}</textarea>
                    </div>

                    <select name="product_type" class="form-select form-select-lg mb-4" aria-label="Default select example" required>
                        @foreach ($productTypes as $productType)
                        {{$selected = $product->getIdProductType() == $productType->getId()}}
                        <option value="{{$productType->getId()}}" @if ($selected) selected @endif>
                            {{$productType->getName()}}
                        </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-success btn-lg">Salvar</button>
                </form>
            </div>
        </div>
    </section>
    <script src="../../updateFormImage.js"></script>
</main>