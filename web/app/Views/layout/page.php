<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desafio SoftExpert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="../floatingdiv.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-dark-subtle rounded" aria-label="Thirteenth navbar example">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
                <a class="navbar-brand col-lg-3 me-0" href="/">
                    <i class="bi bi-journal-text"></i>
                    Home
                </a>
                <ul class="navbar-nav col-lg-9 justify-content-lg-end">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sales">
                            <i class="bi bi-cart"></i>
                            Vendas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/user">
                            <i class="bi bi-person"></i>
                            Usuários
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products">
                            <i class="bi bi-box-seam"></i>
                            Produtos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/product_types">
                            <i class="bi bi-tags"></i>
                            Tipos de produto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tax">
                            <i class="bi bi-currency-dollar"></i>
                            Impostos
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Conta
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/logout">Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="container mt-3">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>