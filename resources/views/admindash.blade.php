<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN DASHBOARD </title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/scss/app.scss'])

</head>

<body>
    @if ($message = Session::get('success'))
        <div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <p id="successMessage">{{ $message }}<< /p>
                    </div>
                </div>
            </div>
        </div>
    @endif



    <div class="app-container">
        <div id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <div class="app-icon">
                    <img height="80" width="170" src="{{ asset('dist/logo-CBACE.PNG') }}" alt="">
                </div>
            </div>
            <ul class="sidebar-list">
                @include('layouts.sidebar')
            </ul>
            <div class="account-info">
                <div class="account-info-picture">
                    <img src="{{ asset('avatars/' . auth()->user()->avatar->image) }}" alt="Account">
                </div>
                <div class="account-info-name">{{ auth()->user()->prenoms }}</div>
            </div>
        </div>
        <div class="main-container">
            <div class="app-head">
                @include('layouts.dashhead')
            </div>
            <div class="app-content">
                <div id="relances">
                    <h3 style="color: #fff" class="text-center">RELANCES DES CLIENTS</h3>
                    <hr style="color: #fff;">
                </div>
                <div id="clients">
                    <div class="products-area-wrapper tableView">
                        <div class="products-header">
                            <div class="product-cell image">
                                Prénoms & Nom
                                <button class="sort-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="product-cell category">Type<button class="sort-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                    </svg>
                                </button></div>
                            <div class="product-cell status-cell">Status<button class="sort-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                    </svg>
                                </button></div>

                            <div class="product-cell stock">Détails<button class="sort-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M496.1 138.3L375.7 17.9c-7.9-7.9-20.6-7.9-28.5 0L226.9 138.3c-7.9 7.9-7.9 20.6 0 28.5 7.9 7.9 20.6 7.9 28.5 0l85.7-85.7v352.8c0 11.3 9.1 20.4 20.4 20.4 11.3 0 20.4-9.1 20.4-20.4V81.1l85.7 85.7c7.9 7.9 20.6 7.9 28.5 0 7.9-7.8 7.9-20.6 0-28.5zM287.1 347.2c-7.9-7.9-20.6-7.9-28.5 0l-85.7 85.7V80.1c0-11.3-9.1-20.4-20.4-20.4-11.3 0-20.4 9.1-20.4 20.4v352.8l-85.7-85.7c-7.9-7.9-20.6-7.9-28.5 0-7.9 7.9-7.9 20.6 0 28.5l120.4 120.4c7.9 7.9 20.6 7.9 28.5 0l120.4-120.4c7.8-7.9 7.8-20.7-.1-28.5z" />
                                    </svg>
                                </button></div>

                        </div>
                        @forelse ($clients as $client)
                            <div class="products-row">
                                <button class="cell-more-button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-more-vertical">
                                        <circle cx="12" cy="12" r="1" />
                                        <circle cx="12" cy="5" r="1" />
                                        <circle cx="12" cy="19" r="1" />
                                    </svg>
                                </button>
                                <div class="product-cell image">
                                    <img src="{{ asset('avatars/' . $client->avatar->image) }}" alt="photo du client">
                                    <span>{{ $client->prenoms }} {{ $client->nom }} </span>
                                </div>
                                <div class="product-cell category"><span class="cell-label">Category:</span>
                                    {{ $client->origine }}
                                </div>
                                <div class="product-cell status-cell">
                                    <span class="cell-label">Status:</span>
                                    <span class="status disabled">Disabled</span>
                                </div>
                                <div class="product-cell sales">
                                    <button class="btn btn-outline-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg>
                                    </button>
                                </div>

                            </div>
                        @empty
                            <div class="text-center" style="color:#fff;">
                                INDISPONIBLE!
                            </div>
                        @endforelse
                    </div>
                </div>
                <div id="settings">
                    <h3 style="color: #fff" class="text-center">PARAMETRES DE COMPTE</h3>
                    <hr style="color: #fff;">
                    <div class="container">
                        <div class="row justify-content-center">

                            <div class="col-auto mx-1 mx-md-3">
                                <div class="card mb-4" data-bs-toggle="modal" data-bs-target="#ModalPass">

                                    <img src="{{ asset('dist/lockT.jpg') }}" class="card-img-top" alt="...">

                                    <div class="card-body">
                                        <p class="card-text text-center">Mettre à jour mon mot de passe</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mx-1 mx-md-3">
                                <div class="card mb-4" data-bs-toggle="modal" data-bs-target="#ModalPic">
                                    <img src="{{ asset('avatars/' . auth()->user()->avatar->image) }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text text-center">Mettre à jour ma photo de profil</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Modal photo de profil -->
                        <div class="modal fade" id="ModalPic" tabindex="-1" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">PHOTO DE PROFIL</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('image.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="file" name="image" class="form-control" id="photo"
                                                name="photo">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal mot de passe -->
                        <div class="modal fade" id="ModalPass" tabindex="-1" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">MOT DE PASSE</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="passwordForm" action="{{ route('password.update') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="currentPassword" class="form-label">Current
                                                    Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="oldPass" class="form-control"
                                                        id="currentPassword">
                                                    <span class="input-group-text" id="currentPasswordToggle">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-eye-fill"
                                                            viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                            <path
                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="newPassword" class="form-label">New Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="newPass" class="form-control"
                                                        id="newPassword">
                                                    <span class="input-group-text" id="newPasswordToggle">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-eye-fill"
                                                            viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                            <path
                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirmPassword" class="form-label">Confirm New
                                                    Password</label>
                                                <div class="input-group">
                                                    <input type="password" name="verifyPass" class="form-control"
                                                        id="confirmPassword">
                                                    <span class="input-group-text" id="confirmPasswordToggle">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-eye-fill"
                                                            viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                            <path
                                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit"
                                                onclick="return confirm('Vous serez amener à vous reconnecter,êtes-vous sûr?');"
                                                class="btn btn-primary" id="saveChangesButton">Save changes</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal adhesion -->
                        <div id="modal-backdrop"></div>

                    </div>
                </div>
              
            </div>
        </div>

    </div>
</body>

</html>
