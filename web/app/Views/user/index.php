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

                <div class="mt-5">
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
        </div>
    </section>
</main>