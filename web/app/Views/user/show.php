@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light mb-5">Listagem de Usuários</h1>

                <div class="d-flex justify-content-center">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            Featured
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$user->getName()}}</li>
                            <li class="list-group-item">{{$user->getEmail()}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>