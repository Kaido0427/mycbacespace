<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DASHBOARD | CBACE-CGA</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://app.cbace-cga.com/build/manifest.json">
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/scss/app.scss'])

 

</head>

<body>
 
    <div class="app-container">
        <div id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <div class="app-icon">
                    <img height="80" width="170" src="{{ asset('dist/logo-CBACE.png') }}" alt="">
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
                    <img id="sidebar-pic" src="{{ asset('avatars/' . auth()->user()->avatar->image) }}" alt="Account">
                </div>
                <div class="account-info-name" id="account-info-name">{{ auth()->user()->prenoms }}
                    {{ auth()->user()->nom }}</div>

            </div>
        </div>
        <div class="main-container">
            <div class="app-head">
                @include('layouts.dashhead') 
            </div>
            <div class="app-content" style="overflow: auto; height: calc(100vh - var(--header-height, 0px)); width: calc(100vw - var(--header-width, 0px));">

                <div id="profil">
                    <h3 class="text-center">MON PROFIL</h3>
                    <hr>
                    <!-- Modal -->
                    <div class="modal fade modal-transparent-blur" id="adhDetails" tabindex="-1" role="dialog"
                        aria-labelledby="userInfoModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userInfoModalLabel">DETAILS DE L'ADHESION</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="mb-3">
                                        <strong>Date d'adhésion :</strong>
                                        <div>
                                            {{ \Carbon\Carbon::parse(auth()->user()->dateCreate)->isoFormat('D MMMM YYYY') }}
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="mb-3">
                                        <strong>Raison sociale :</strong>
                                        <div>{!! Auth::user()->raison !!}</div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>Déclaration :</strong>
                                        <div>{!! Auth::user()->declaration !!}</div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>
                                            @php
                                                $serviceCount = Auth::user()->services->unique('id')->count();
                                            @endphp
                                            {{ $serviceCount === 1 ? 'Service' : 'Services' }} :
                                        </strong>
                                        <ul>
                                            @foreach (Auth::user()->services->unique('id') as $service)
                                                <li>{{ $service->nom_service }}</li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <hr>
                                    <div class="mb-3">
                                        <strong>Engagement :</strong>
                                        <div>{!! Auth::user()->engagement !!}</div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>Engagement supplémentaire :</strong>
                                        <div>{!! Auth::user()->engagsup !!}</div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>Date de creation de l'entreprise :</strong>
                                        <div>
                                            {{ \Carbon\Carbon::parse(auth()->user()->date)->isoFormat('D MMMM YYYY') }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>Origine :</strong>
                                        <div>
                                            @foreach ($user->procedures->unique('id')->pluck('categorie')->unique('id') as $categorie)
                                                {{ $categorie->nom_categorie }}
                                            @endforeach
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="mb-3">
                                        <strong>Numéro d'associés :</strong>
                                        <div>{!! Auth::user()->numAssocies !!}</div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <strong>Régime :</strong>
                                        <div>{!! Auth::user()->regime !!}</div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-dark"
                                        data-bs-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="modal-backdrop"></div>

                    <div class="container">
                        <div class="main-body">
                            <div class="row gutters-sm justify-content-center">
                                <div class="col-auto mx-1 mx-md-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex flex-column justify-content-center">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <div id="image-profil">
                                                    <img id="ppImg"
                                                        src="{{ asset('avatars/' . auth()->user()->avatar->image) }}"
                                                        alt="Admin">
                                                </div>


                                                <div class="mt-3">
                                                    <h4 id="ppName">{{ auth()->user()->nom }}
                                                        {{ auth()->user()->prenoms }}</h4>
                                                    <p class="text-secondary mb-1">+229 {{ auth()->user()->telephone }}
                                                        </< /p>
                                                    <p id="ppAdd" class="text-muted font-size-sm">
                                                        {{ auth()->user()->adresse }},{{ auth()->user()->bp }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto mx-1 mx-md-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="row">
                                                            <div class="col-sm-12 btn">
                                                                <strong>INFORMATIONS D'ADHESION</strong>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Date Adhésion</h6>
                                                        </div>
                                                        <div class="col-sm-9 ">
                                                            {{ \Carbon\Carbon::parse(auth()->user()->dateCreate)->isoFormat('D MMMM YYYY') }}

                                                        </div>
                                                        <hr>
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">
                                                                @php
                                                                    $serviceCount = $user->services
                                                                        ->unique('id')
                                                                        ->count();
                                                                @endphp
                                                                {{ $serviceCount === 1 ? 'Service' : 'Services' }}
                                                            </h6>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <ul>
                                                                @foreach ($user->services->unique('id') as $service)
                                                                    <li>{{ $service->nom_service }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>


                                                        <hr>
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Structure</h6>
                                                        </div>
                                                        <div class="col-sm-9 ">
                                                            @foreach ($user->procedures->unique('id')->pluck('categorie')->unique('id') as $categorie)
                                                                {{ $categorie->nom_categorie }}
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div data-bs-toggle="modal" data-bs-target="#adhDetails"
                                                            class="col-sm-12 btn btn-primary">
                                                            Details
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <div class="card mb-3 h-100">
                                                <div class="card-body">
                                                    <div class="col-sm-12 btn">
                                                        <strong>MA PROGRESSION</strong>
                                                    </div>
                                                    <div class="progress mb-3" style="height: 5px">
                                                        <div class="progress-bar bg-primary progress-bar-animated"
                                                            id="progressbar" role="progressbar" style="width: 0%"
                                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tasks">
                    <h3 class="text-center">MES TACHES</h3>
                    <hr>
                    <div class="row">
                        @foreach ($user->taches as $tache)
                            <div class="col ">
                                <div class="card mb-4" id="task-{{ $tache->id }}">
                                    <div class="card-header  d-flex">

                                        <h5 class="card-title">{{ $tache->nom_tache }}</h5>

                                        <div class="ms-auto">
                                            @if (!empty($tache->pivot->doc_client))
                                                @if (!empty($tache->pivot->doc_traité))
                                                    <a href="{{ asset('document_clients/' . $tache->pivot->doc_client) }}"
                                                        class="btn btn-success" download>
                                                        Télécharger le fichier traité
                                                    </a>
                                                @else
                                                    <button type="button" class="btn btn-warning open-task-modal"
                                                        data-bs-toggle="modal" data-bs-target="#taskModal"
                                                        data-procedure-id="{{ $tache->pivot->id }}">
                                                        Modifier le fichier
                                                    </button>
                                                @endif
                                            @else
                                                <button type="button" class="btn btn-primary open-task-modal"
                                                    data-bs-toggle="modal" data-bs-target="#taskModal"
                                                    data-procedure-id="{{ $tache->id }}">
                                                    Soumettre
                                                </button>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="card-body">
                                        {{ $tache->description }}

                                        @if (!empty($tache->pivot->doc_client))
                                            <div class="mt-3" style="width: 100%;">
                                                @if (pathinfo($tache->pivot->doc_client, PATHINFO_EXTENSION) === 'pdf')
                                                    <embed id="taskFiles"
                                                        src="{{ asset('document_clients/' . $tache->pivot->doc_client) }}"
                                                        type="application/pdf" width="100%" height="150px">
                                                @else
                                                    <a href="{{ asset('document_clients/' . $tache->pivot->doc_client) }}"
                                                        target="_blank">
                                                        <img style="object-fit: cover"
                                                            src="{{ asset('dist/word-logo.webp') }}"
                                                            alt="Word document" width="100%" height="150px">
                                                    </a>
                                                @endif
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Done tasks</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="taskForm" action="{{ route('task.update') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="tache_id" id="tache_id">
                                        <input type="file" name="doc_client" class="form-control" id="docclient">
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button id="save-changes-btn" type="button" class="btn btn-primary">Completer la
                                        tache</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="loaderModal" tabindex="-1" aria-labelledby="loaderModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modal-backdrop"></div>

                </div>

                <div id="relances">
                    <h3 class="text-center">MES NOTIFICATIONS</h3>
                    <hr>
                    <section class="section-50">
                        <div class="container">
                            <div class="notification-ui_dd-content">
                                @forelse ($notifications as $notification)
                                    <div class="notification-list unread" id="notification-{{ $notification->id }}">
                                        <div class="notification-list_content">
                                            <div class="notification-list_img">
                                                @if ($notification->status === 'Attente')
                                                    <img src="{{ asset('dist/notiftaskcancel.png') }}"
                                                        alt="user">
                                                @elseif ($notification->status === 'Terminé')
                                                    <img src="{{ asset('dist/notiftasksuccess.png') }}"
                                                        alt="user">
                                                @else
                                                    <img src="{{ asset('dist/notiftaskpending.png') }}"
                                                        alt="user">
                                                @endif
                                            </div>
                                            <div class="notification-list_detail">
                                                <p class="text-muted">{{ $notification->message }}</p>
                                                <p class="text-muted">
                                                    <small>{{ $notification->created_at->diffForHumans() }}</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="notification-list_feature-img">
                                            <button type="button"
                                                onclick="return confirm('Etes-vous sûr de vouloir supprimer cette notification?');"
                                                class="btn btn-sm btn-danger delete-notification-btn"
                                                data-notification-id="{{ $notification->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path
                                                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="no-notifications">
                                        <h3>
                                            <span class="letter-animation word">Aucune</span>&nbsp;
                                            <span style="color: #29B6F6;"
                                                class="letter-animation word">notification</span>&nbsp;
                                            <span class="letter-animation word">pour</span>&nbsp;
                                            <span class="letter-animation word">le</span>&nbsp;
                                            <span class="letter-animation word">moment.</span>
                                        </h3>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </section>
                </div>

                <div id="settings">
                    <h3 class="text-center">PARAMETRES DE COMPTE</h3>
                    <hr>
                    <div class="container">
                        <div class="row justify-content-center">

                            <div class="col-auto mx-1 mx-md-3">
                                <div class="card mb-4" data-bs-toggle="modal" data-bs-target="#Modalinfo">

                                    <img src="{{ asset('dist/listT.jpg') }}" class="card-img-top" alt="...">

                                    <div class="card-body">
                                        <p class="card-text text-center">Mettre à jour mes informations standard</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto mx-1 mx-md-3">
                                <div class="card mb-4" data-bs-toggle="modal" data-bs-target="#Modaladh">

                                    <img src="{{ asset('dist/list2T.jpg') }}" class="card-img-top" alt="...">

                                    <div class="card-body">
                                        <p class="card-text text-center">Mettre à jour mes informations d'adhesion</p>
                                    </div>
                                </div>
                            </div>
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
                                    <img id="profile-pic" src="{{ asset('avatars/' . $user->avatar->image) }}"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text text-center">Mettre à jour ma photo de profil</p>
                                    </div>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal photo de profil -->
                        <div class="modal fade modal-transparent-blur" id="ModalPic" tabindex="-1"
                            aria-labelledby="ModalLabel" aria-hidden="true">
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
                        <div class="modal fade modal-transparent-blur" id="ModalPass" tabindex="-1"
                            aria-labelledby="ModalLabel" aria-hidden="true">
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

                        <!-- Modal info -->
                        <div class="modal fade modal-transparent-blur" id="Modalinfo" tabindex="-1"
                            aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">MES INFORMATIONS</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="infoForm" action="{{ route('user.update') }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Nom</label>
                                                <div class="input-group">
                                                    <input type="text" name="nom" class="form-control"
                                                        id="nom" value="{{ auth()->user()->nom }}">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="prenoms" class="form-label">Prénoms
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="prenoms" class="form-control"
                                                        id="prenoms" value="{{ auth()->user()->prenoms }}">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="adresse" class="form-label">Adresse
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="adresse" class="form-control"
                                                        id="adresse" value="{{ auth()->user()->adresse }}">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="bp" class="form-label">Boîte Postale
                                                </label>
                                                <div class="input-group">
                                                    <input type="text" name="bp" class="form-control"
                                                        id="bp" value="{{ auth()->user()->bp }}">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telephone" class="form-label">Numéro de télephone
                                                </label>
                                                <div class="input-group">
                                                    <input type="number" name="telephone" class="form-control"
                                                        id="telephone" value="{{ auth()->user()->telephone }}">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary" id="infoButton"
                                                data-bs-toggle="modal" data-bs-target="#loadingModal">Mettre à
                                                jour</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal adhesion -->

                        <div class="modal fade modal-transparent-blur" id="Modaladh" tabindex="-1"
                            aria-labelledby="ModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">MES INFORMATIONS
                                            D'ADHESION</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="adhForm" action="" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Origine</label>
                                                <div class="input-group">
                                                    <input type="text" name="origine" class="form-control"
                                                        id="origine" placeholder="{{ auth()->user()->origine }}">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit"
                                                    onclick="return confirm('Vous serez amener à vous reconnecter,êtes-vous sûr?');"
                                                    class="btn btn-primary" id="adhButton">Mettre à
                                                    jour</button>

                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="modal-backdrop"></div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            updateProgressBar();
        });

        function updateProgressBar() {
            $.ajax({
                url: '/tasks',
                type: 'GET',
                dataType: 'json',
                success: function(procedures) {
                    const totalProcedures = procedures.length;
                    const proceduresTerminees = procedures.filter(procedure => procedure.doc_traité !== null)
                        .length;

                    const progressBar = $('#progressbar');
                    if (totalProcedures === 0) {
                        progressBar.css('width', '0%');
                        progressBar.attr('aria-valuenow', 0);
                    } else {
                        const progression = (proceduresTerminees / totalProcedures) * 100;
                        progressBar.animate({
                            width: `${progression}%`
                        }, 1500);
                        progressBar.attr('aria-valuenow', progression);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fonction pour vérifier s'il y a des notifications
            function hasNotifications() {
                return $('.notification-list').length > 0;
            }

            // Fonction pour afficher/masquer le message "Aucune notification"
            function toggleNoNotificationsMessage() {
                const noNotificationsMessage = $('.no-notifications');
                const notificationList = $('.notification-list');

                if (notificationList.children().length === 0) {
                    noNotificationsMessage.show();
                    animateWords();
                } else {
                    noNotificationsMessage.hide();
                }
            }


            // Fonction pour animer les mots
            function animateWords() {
                const words = $('.word');
                words.removeClass('letter-animation');

                words.each(function(index) {
                    const word = $(this);
                    setTimeout(function() {
                        word.addClass('letter-animation');
                        animateLetters(word);
                    }, index * 500);
                });

                setTimeout(function() {
                    animateWords();
                }, words.length * 500 + 500);
            }

            // Fonction pour animer les lettres
            function animateLetters(word) {
                const text = word.text().trim();
                word.empty();

                for (let i = 0; i < text.length; i++) {
                    const letter = $('<span>').text(text[i]);
                    word.append(letter);

                    setTimeout(function() {
                        letter.css('animation-delay', `${i * 0.1}s`);
                    }, 10);
                }
            }

            // Appeler la fonction pour afficher/masquer le message "Aucune notification"
            toggleNoNotificationsMessage();

            $('.delete-notification-btn').each(function() {
                const button = $(this);
                const notificationId = button.data('notification-id');

                button.on('click', function(event) {
                    event.preventDefault();

                    const notificationElement = $('#notification-' + notificationId);
                    console.log('Button clicked. Notification ID:', notificationId);

                    // Remplacer l'icône trash par le spinner
                    button.html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                    );

                    // Délai de 500ms pour simuler le traitement
                    setTimeout(function() {
                        $.ajax({
                            url: '/notifications/' + notificationId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                console.log(
                                    'Notification deleted successfully. Response:',
                                    response
                                );

                                // Effet de fade right pour supprimer la notification
                                notificationElement.addClass('fade-right');

                                // Vérifier si des notifications sont encore présentes
                                toggleNoNotificationsMessage();

                                // Supprimer l'élément de notification après la fin de l'animation
                                notificationElement.one('animationend',
                                    function() {
                                        notificationElement.remove();
                                    });
                            },

                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error(
                                    'Error deleting notification. Text status:',
                                    textStatus, 'Error thrown:', errorThrown
                                );
                                console.error(jqXHR.responseJSON);
                            },
                            complete: function() {
                                // Restaurer l'icône trash après la suppression
                                button.html(
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/></svg>'
                                );
                            }
                        });
                    }, 500); // Délai de 500ms
                });
            });
        });
    </script>
</body>

</html>
