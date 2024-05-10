<header>
    <section class="border-bottom border-black">
        <nav class="navbar navbar-expand-sm navbar-light bg-danger">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-6">
                        <a class="navbar-brand" href="https://www.youtube.com/watch?v=5DjOL2we8ko">"I like trains.."</a>
                        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="col-6">
                        <div class="collapse navbar-collapse" id="collapsibleNavId">
                            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('guests.home') }}" aria-current="page">Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('guests.trains.index') }}">Trains</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </section>

</header>
