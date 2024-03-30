<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DASHBOARD | CBACE-CGA</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/scss/app.scss', 'resources/scss/notif.scss'])

</head>

<body>
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
                <div class="account-info-name">{{ auth()->user()->prenoms }} {{ auth()->user()->nom }}</div>
            </div>
        </div>
        <div class="main-container">
            <div class="app-head">
                @include('layouts.dashhead')
            </div>
            <div class="app-content" style="overflow-y: auto; height: calc(100vh - );">
                <div id="relances">
                    <h3 style="color: #000" class="text-center">MES RAPPELS</h3>
                    <hr style="color: #fff;">
                    <section class="section-50">
                        <div class="container">
                            <div class="notification-ui_dd-content">
                                <div class="notification-list notification-list--unread">
                                    <div class="notification-list_content">
                                        <div class="notification-list_img">
                                            <img src="https://i.imgur.com/zYxDCQT.jpg" alt="user">
                                        </div>
                                        <div class="notification-list_detail">
                                            <p><b>John Doe</b> reacted to your post</p>
                                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing
                                                elit. Unde, dolorem.</p>
                                            <p class="text-muted"><small>10 mins ago</small></p>
                                        </div>
                                    </div>
                                    <div class="notification-list_feature-img">
                                        <img src="https://i.imgur.com/AbZqFnR.jpg" alt="Feature image">
                                    </div>
                                </div>
                                <div class="notification-list">
                                    <div class="notification-list_content">
                                        <div class="notification-list_img">
                                            <img src="https://i.imgur.com/ltXdE4K.jpg" alt="user">
                                        </div>
                                        <div class="notification-list_detail">
                                            <p><b>Brian Cumin</b> reacted to your post</p>
                                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing
                                                elit. Unde, dolorem.</p>
                                            <p class="text-muted"><small>10 mins ago</small></p>
                                        </div>
                                    </div>
                                    <div class="notification-list_feature-img">
                                        <img src="https://i.imgur.com/bpBpAlH.jpg" alt="Feature image">
                                    </div>
                                </div>
                            
                            </div>

                        </div>
                    </section>
                </div>
                <div id="settings">
                    <h3 style="color: #fff" class="text-center">PARAMETRES DE COMPTE</h3>
                    <hr style="color: #fff;">
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

                        <!-- Modal info -->
                        <div class="modal fade" id="Modalinfo" tabindex="-1" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">MES INFORMATIONS</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="InfoForm" action="{{ route('user.update') }}" method="POST">
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
                                            <button type="submit"
                                                onclick="return confirm('Vous serez amener à vous reconnecter,êtes-vous sûr?');"
                                                class="btn btn-primary" id="saveChangesButton">Mettre à jour</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal adhesion -->

                        <div class="modal fade" id="Modaladh" tabindex="-1" aria-labelledby="ModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">MES INFORMATIONS
                                            D'ADHESION</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="passwordForm" action="" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Origine</label>
                                                <div class="input-group">
                                                    <input type="text" name="nom" class="form-control"
                                                        id="nom" placeholder="{{ auth()->user()->origine }}">
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit"
                                                    onclick="return confirm('Vous serez amener à vous reconnecter,êtes-vous sûr?');"
                                                    class="btn btn-primary" id="saveChangesButton">Mettre à
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
</body>

</html>
