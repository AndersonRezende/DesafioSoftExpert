@layout('page')
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-9 col-md-8 mx-auto">
                <h1 class="fw-light">Listagem de Usuários</h1>
                <a type="button" class="btn btn-primary" href="/user/new">
                    <i class="bi bi-plus"></i>
                    Adicionar
                </a>

                <form class="mt-5" method="get" action="/user/busca/">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="search" class="col-form-label">Nome</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="search" class="form-control" aria-describedby="passwordHelpInline" name="name">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i>
                                Pesquisar
                            </button>
                        </div>
                    </div>
                </form>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->getId()}}</td>
                        <td><a href="/user/{{$user->getId()}}">{{$user->getName()}}</a></td>
                        <td>{{$user->getName()}}</td>
                        <td>{{$user->getEmail()}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>