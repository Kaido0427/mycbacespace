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
            <div class="app-content" style="overflow-y: auto; height: calc(100vh - );">
                <div id="profil">
                    <h3 style="color: #fff" class="text-center">MON PROFIL</h3>
                    <hr style="color: #fff;">
                </div>
                <div id="tasks">
                    <h3 style="color: #fff" class="text-center">MES TACHES</h3>
                    <hr style="color: #fff;">
                </div>
                <div id="relances">
                    <h3 style="color: #000" class="text-center">MES NOTIFICATIONS</h3>
                    <hr style="color: #fff;">
                    <section class="section-50">
                        <div class="container">
                            <div class="notification-ui_dd-content">
                                <div class="notification-list unread">
                                    <div class="notification-list_content">
                                        <div class="notification-list_img">
                                            <img src="{{ asset('dist/notiftaskpending.png') }}" alt="user">
                                        </div>
                                        <div class="notification-list_detail">
                                            <p><b>Administrateur</b></p>
                                            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing
                                                elit. Unde, dolorem.</p>
                                            <p class="text-muted"><small>10 mins ago</small></p>
                                        </div>
                                    </div>
                                    <div class="notification-list_feature-img">
                                        <img src="https://i.imgur.com/AbZqFnR.jpg" alt="Feature image">
                                    </div>
                                </div>
                                <div class="notification-ui_dd-content">
                                    <div class="notification-list unread">
                                        <div class="notification-list_content">
                                            <div class="notification-list_img">
                                                <img src="{{ asset('dist/notiftaskcancel.png') }}" alt="user">
                                            </div>
                                            <div class="notification-list_detail">
                                                <p><b>Administrateur</b></p>
                                                <p class="text-muted">Lorem ipsum dolor sit amet consectetur,
                                                    adipisicing
                                                    elit. Unde, dolorem.</p>
                                                <p class="text-muted"><small>10 mins ago</small></p>
                                            </div>
                                        </div>
                                        <div class="notification-list_feature-img">
                                            <img src="https://i.imgur.com/AbZqFnR.jpg" alt="Feature image">
                                        </div>
                                    </div>
                                    <div class="notification-list read">
                                        <div class="notification-list_content">
                                            <div class="notification-list_img">
                                                <img src="{{ asset('dist/notiftasksuccess.png') }}" alt="user">
                                            </div>
                                            <div class="notification-list_detail">
                                                <p><b>Administrateur</b></p>
                                                <p class="text-muted">Lorem ipsum dolor sit amet consectetur,
                                                    adipisicing
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
                                    <img id="profile-pic"
                                        src="{{ asset('avatars/' . auth()->user()->avatar->image) }}"
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

                                        <!-- Message -->
                                        <p id="loadingMessage" class="mt-2">Patientez un instant</p>
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
</body>

</html>
