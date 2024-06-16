@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light mb-5">Cadastro de Usuário</h1>
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
                <form action="/users/store" method="post">
                    <div class="row mb-4">
                        <div class="col-12">
                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <label class="form-label" for="typeName">Nome</label>
                                <input name="name" type="text" id="typeName" class="form-control form-control-lg" required/>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="priceInput">Email</label>
                                <input name="email" type="email" id="priceInput" class="form-control form-control-lg" required/>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <div data-mdb-input-init class="form-outline form-white mb-4">
                                <label class="form-label" for="typePassword">Senha</label>
                                <input name="password" type="password" id="typePassword" class="form-control form-control-lg" required/>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-outline form-white mb-4">
                                <label class="form-label" for="typePasswordConfirmation">Confirmação de senha</label>
                                <input name="password_confirmation" type="password" id="typePasswordConfirmation" class="form-control form-control-lg" required/>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-lg">Salvar</button>
                </form>
            </div>
        </div>
        </div>
    </section>
</main>