<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADMIN DASHBOARD </title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/scss/app.scss'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
                <div class="account-info-logout">
                    <a style="color: red;text-decoration:none;" href="{{ route('auth.logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                            <path fill-rule="evenodd"
                                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                        </svg>
                        <span> {{ __('Déconnexion') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('auth.logout') }}" method="post" class="d-none">
                        @csrf
                    </form>
                </div>

                <div class="account-info-picture">
                    @if (auth()->user()->avatar)
                        <img id="sidebar-pic" src="{{ asset('avatars/' . auth()->user()->avatar->image) }}"
                            alt="Account">
                    @else
                        <img id="sidebar-pic" src="{{ asset('dist/user-default.png') }}" alt="Account">
                    @endif

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
                    <h3 class="text-center">RELANCES DES CLIENTS</h3>
                    <hr style="color: #fff;">
                </div>
                <div id="clients">
                    <h3 class="text-center">ADHERANTS</h3>
                    <hr>
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
                            <div class="product-cell status-cell">Date d'adhésion<button class="sort-button">
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
                                    <img style="object-fit: cover;"
                                        src="{{ asset('avatars/' . $client->avatar->image) }}" alt="photo du client">
                                    <span>{{ $client->prenoms }} {{ $client->nom }} </span>
                                </div>
                                <div class="product-cell category"><span class="cell-label">Category:</span>
                                    {{ $client->procedures->unique('id')->pluck('categorie')->unique('id')->pluck('nom_categorie')->join(',') }}

                                </div>
                                <div class="product-cell status-cell">

                                    <span
                                        class="status">{{ \Carbon\Carbon::parse(auth()->user()->dateCreate)->isoFormat('D MMMM YYYY') }}</span>
                                </div>
                                <div class="product-cell sales">
                                    <button data-bs-toggle="modal" data-bs-target="#fullscreenModal"
                                        class="btn btn-outline-primary" data-client-id="{{ $client->id }}"
                                        data-client-image="{{ asset('avatars/' . $client->avatar->image) }}"
                                        data-client-datecreate="{{ \Carbon\Carbon::parse(auth()->user()->dateCreate)->isoFormat('D MMMM YYYY') }}"
                                        data-client-reason="{{ $client->raison }}"
                                        data-client-declaration="{{ $client->declaration }}"
                                        data-client-service="<ul>{{ $client->services->unique('id')->map(function ($service) {
                                                return '<li>' . e($service->nom_service) . '</li>';
                                            })->join('') }}</ul>"
                                        data-client-engagement="{{ $client->engagement }}"
                                        data-engag-sup-client="{{ $client->engagsup }}"
                                        data-entreprise-client-date="{{ \Carbon\Carbon::parse(auth()->user()->date)->isoFormat('D MMMM YYYY') }}"
                                        data-origine-client="{{ $client->procedures->unique('id')->map(function ($procedure) {
                                                return $procedure->categorie->nom_categorie;
                                            })->unique()->join(',') }}"
                                        data-client-associes="{{ $client->numAssocies }}"
                                        data-client-regime="{{ $client->regime }}"
                                        data-client-nom="{{ $client->nom }}"
                                        data-client-prenoms="{{ $client->prenoms }}">
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
                            <div class="text-center">
                                INDISPONIBLE!
                            </div>
                        @endforelse
                    </div>

                    <!-- Modal -->

                    <div class="modal fade modal-transparent-blur" id="fullscreenModal" tabindex="-1"
                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="client-name"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12 col-md-4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        @if ($client)
                                                            <img id="img-client" class="img-fluid"
                                                                style="object-fit: cover; border-radius: 0.5rem; max-height: 200px;"
                                                                src="{{ asset('avatars/' . $client->avatar->image) }}"
                                                                alt="">
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>
                                                <hr class="invisible-hr">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <strong>Date d'adhésion :</strong>
                                                            <div id="datecreate-client">

                                                            </div>
                                                        </div>
                                                        <hr class="invisible-hr">
                                                        <div class="mb-3">
                                                            <strong>Raison sociale :</strong>
                                                            <div id="client-reason"></div>
                                                        </div>
                                                        <hr class="invisible-hr">
                                                        <div class="mb-3">
                                                            <strong>Déclaration :</strong>
                                                            <div id="client-declaration"></div>
                                                        </div>
                                                        <hr class="invisible-hr">
                                                        <div class="mb-3">
                                                            <strong>Service :</strong>
                                                            <div id="client-service"></div>
                                                        </div>
                                                        <hr class="invisible-hr">
                                                        <div class="mb-3">
                                                            <strong>Engagement :</strong>
                                                            <div id="client-engagement"></div>
                                                        </div>
                                                        <hr class="invisible-hr">
                                                        <div class="mb-3">
                                                            <strong>Engagement supplémentaire :</strong>
                                                            <div id="engag-sup-client"></div>
                                                        </div>
                                                        <hr class="invisible-hr">
                                                        <div class="mb-3">
                                                            <strong>Date de creation de l'entreprise :</strong>
                                                            <div id="entreprise-client-date">

                                                            </div>
                                                        </div>
                                                        <hr class="invisible-hr">
                                                        <div class="mb-3">
                                                            <strong>Origine :</strong>
                                                            <div id="origine-client"></div>
                                                        </div>
                                                        <hr class="invisible-hr">
                                                        <div class="mb-3">
                                                            <strong>Numéro d'associés :</strong>
                                                            <div id="client-associes"></div>
                                                        </div>
                                                        <hr class="invisible-hr">
                                                        <div class="mb-3">
                                                            <strong>Régime :</strong>
                                                            <div id="client-regime"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-8 ">
                                                <table id="client-table" class="table-responsive">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Tâche</th>
                                                            <th scope="col">Document(docx,pdf)</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Tâche 1</td>
                                                            <td></td>
                                                            <td>En cours</td>
                                                            <td><button type="button"
                                                                    class="btn btn-primary">Action</button></td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Fermer</button>

                                </div>
                            </div>
                        </div>
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
                                    @if ($user->avatar)
                                        <img id="profile-pic"
                                            src="{{ asset('avatars/' . auth()->user()->avatar->image) }}"
                                            class="card-img-top" alt="...">
                                    @else
                                        <img class="card-img-top" src="{{ asset('dist/user-default.png') }}"
                                            alt="Account">
                                    @endif
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
                                    <form id="image-form" action="{{ route('image.store') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="file" name="image" class="form-control"
                                                id="photo">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" id="submit-button" class="btn btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#loadingModal">Enregistrer</button>
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
                                                <label for="currentPassword" class="form-label">Mot de passe
                                                    actuel</label>
                                                <div class="input-group">
                                                    <input type="password" name="oldPass" class="form-control"
                                                        id="currentPassword" oninput="checkCurrentPassword()">
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
                                                <span class="error-message" id="currentPasswordError"></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="newPassword" class="form-label">Nouveau Mot de
                                                    Passe</label>
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
                                                <span class="error-message" id="newPasswordError"></span>
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirmPassword" class="form-label">Confirmez le nouveau
                                                    mot de passe
                                                </label>
                                                <div class="input-group">
                                                    <input type="password" name="verifyPass" class="form-control"
                                                        id="confirmPassword" oninput="checkPasswordMatch()">
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
                                                <span class="error-message" id="confirmPasswordError"></span>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit"
                                                onclick="return confirm('Vous serez amener à vous reconnecter,êtes-vous sûr?');"
                                                class="btn btn-primary" id="saveChangesButton">Enregistrer</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <!-- Animation de chargement -->
                                        <div id="loadingSpinner" class="spinner-border text-primary" role="status">
                                            <span class="visually-hidden">Chargement...</span>
                                        </div>

                                        <!-- Message -->
                                        <p id="loadingMessage" class="mt-2">Patientez un instant</p>
                                    </div>
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

    <script>
        function checkCurrentPassword() {
            var currentPassword = document.getElementById("currentPassword");
            var currentPasswordError = document.getElementById("currentPasswordError");

            // Vérifier si l'utilisateur a fini de saisir le mot de passe actuel
            if (currentPassword.value.length === 0) {
                currentPasswordError.textContent = "";
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "{{ route('check.password') }}", true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status == 'error') {
                        currentPasswordError.textContent = response.message;
                        currentPasswordError.style.color = "red";
                        currentPasswordError.style.fontSize = "12px";
                    } else {
                        currentPasswordError.textContent = "";
                    }
                }
            };

            xhr.send(JSON.stringify({
                password: currentPassword.value
            }));
        }

        function checkPasswordMatch() {
            var newPassword = document.getElementById("newPassword");
            var confirmPassword = document.getElementById("confirmPassword");
            var newPasswordError = document.getElementById("newPasswordError");
            var confirmPasswordError = document.getElementById("confirmPasswordError");

            if (confirmPassword.value !== '') {
                if (newPassword.value !== confirmPassword.value) {
                    newPasswordError.textContent = "Les mots de passe ne correspondent pas";
                    newPasswordError.style.color = "red";
                    newPasswordError.style.fontSize = "12px";
                    confirmPasswordError.textContent = "Les mots de passe ne correspondent pas";
                    confirmPasswordError.style.color = "red";
                    confirmPasswordError.style.fontSize = "12px";
                } else {
                    newPasswordError.textContent = "";
                    confirmPasswordError.textContent = "";
                }
            }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
</body>

</html>
