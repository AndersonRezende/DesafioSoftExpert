@layout('auth')
<main>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <form class="mt-5" method="post" action="/auth">
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">Informe seu login e senha!</p>

                                    @if ($errors)
                                    <div class="alert alert-danger" role="alert">
                                        Ocorreu um erro ao validar o(s) seguinte(s) campo(s): <br>
                                        @foreach ($errors as $key => $error)
                                        {{ ucfirst($key) }}
                                        @endforeach
                                    </div>
                                    @endif

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typeEmailX">Email</label>
                                        <input name="email" type="email" id="typeEmailX" class="form-control form-control-lg" required placeholder="Informe seu email"/>
                                    </div>

                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="typePasswordX">Senha</label>
                                        <input name="password" type="password" id="typePasswordX" class="form-control form-control-lg" required placeholder="Informe sua senha"/>
                                    </div>

                                    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                                </form>
                            </div>

                            <div>
                                <p class="mb-0"><a href="/register" class="text-white-50 fw-bold">Cadastro</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>