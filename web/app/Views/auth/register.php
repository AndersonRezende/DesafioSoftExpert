@layout('auth')
<main>
    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <form class="mt-5" method="post" action="/register">
                                    <h2 class="fw-bold mb-2 text-uppercase">Cadastro</h2>
                                    <p class="text-white-50 mb-5">Faça seu cadastro!</p>

                                    @if ($errors)
                                    <div class="alert alert-danger" role="alert">
                                        Ocorreu um erro ao validar o(s) seguinte(s) campo(s): <br>
                                        @foreach ($errors as $key => $error)
                                            {{ ucfirst($key) }}
                                        @endforeach
                                    </div>
                                    @endif

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeName">Nome</label>
                                        <input name="name" type="text" id="typeName" class="form-control form-control-lg" required placeholder="Informe seu nome"/>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeEmail">Email</label>
                                        <input name="email" type="email" id="typeEmail" class="form-control form-control-lg" required placeholder="Informe seu email"/>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typePassword">Senha</label>
                                        <input name="password" type="password" id="typePassword" class="form-control form-control-lg" required placeholder="Informe sua senha"/>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typePasswordConfirmation">Confirme sua senha</label>
                                        <input name="confirm_password" type="password" id="typePasswordConfirmation" class="form-control form-control-lg" required placeholder="Confirme sua senha"/>
                                    </div>

                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Cadastrar</button>
                                </form>
                            </div>

                            <div>
                                <p class="mb-0">Já possui cadastro? Faça seu <a href="/login" class="text-white-50 fw-bold">Login</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>