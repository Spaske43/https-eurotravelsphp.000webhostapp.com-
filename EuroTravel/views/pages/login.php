
<!--MODAL-->
<div class="modal" id="login-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dobrodošli</h5>
                    <a href="index.php?page=Ponude">
                        <button type="button" class="btn-close"
                         data-bs-dismiss="modal" aria-label="Close"></button>
                    </a>
                </div>
                <div class="modal-body" id="login-modal-content">

                </div>
                <div class="modal-footer">
                    <a href="index.php?page=Ponude">
                        <button type="button" class="btn btn-primary">
                            Idi na ponude</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 mb-5">

        <div class="row justify-content-center mb-3">
            <div class="col-12 col-lg-6">
                <div class="alert alert-info user-alert text-center"
                 role="alert" id="login-alert">

                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 bg-dark text-light p-4 rounded">
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email adresa</label>
                        <input type="email" class="form-control" id="email" name="email">
                        <small class="text-danger"></small>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Lozinka</label>
                        <input class="form-control" type="password" id="password" name="password">
                        <small class="text-danger"></small>
                    </div>

                    <button type="button" id="login-btn"
                     class="btn btn-primary px-5 mx-auto d-block">Potvrdi</button>
                </form>
                <p class="text-light text-center mt-4">
                    Nemate nalog na našem sajtu? <a href="index.php?page=register">Registrujte se ovde.</a></p>
            </div>
        </div>
    </div>

    <script src="assets/js/user.js"></script>
