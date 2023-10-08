
<div class="container py-5 mb-5">

<div class="row justify-content-center mb-3">
    <div class="col-12 col-lg-6">
        <div class="alert alert-info user-alert text-center" role="alert" id="register-alert">

        </div>
    </div>
</div>

<div class="row justify-content-center">

<div class="col-12 col-lg-6 bg-dark text-light p-4 rounded">
    <form>
        <div class="mb-3">
            <label for="username" class="form-label">Korisničko ime</label>
            <input type="text" class="form-control" id="username" name="username">
            <small class="text-danger"></small>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email adresa</label>
            <input type="email" class="form-control" id="email" name="email">
            <small class="text-danger"></small>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Telefon</label>
            <input type="text" class="form-control" id="phone" name="phone">
            <small class="text-danger"></small>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Lozinka</label>
            <input class="form-control" type="password" id="password" name="password">
            <small class="text-danger"></small>
        </div>

        <div class="mb-3">
            <label for="passwordConfirm" class="form-label">Potvrdi lozinku</label>
            <input class="form-control" type="password" id="passwordConfirm" name="passwordConfirm">
            <small class="text-danger"></small>
        </div>

        <button type="button" id="register-btn" class="btn btn-primary px-5 mx-auto d-block">Registrujte se</button>
    </form>
    <p class=" text-center mt-4">Imate nalog? <a href="index.php?page=login">Ulogujte se ovde.</a></p>
</div>
</div>
</div>

<script src="assets/js/user.js"></script>

