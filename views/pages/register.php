<div class="container my-5">
    <div class="row">
        <div class="col-12 col-lg-5 mx-auto d-block">

            <div class="alert alert-info alert-animation mb-4" role="alert" id="registerAlert" style="display: none">

            </div>

            <h2 class="fw-bold">Registracija</h2>
            <hr />
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label">Korisničko ime</label>
                    <input type="text" class="form-control" id="username" name="username" >
                    <div class="form-text text-danger"></div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email adresa</label>
                    <input type="email" class="form-control" id="email" name="email" >
                    <div class="form-text text-danger"></div>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Telefon (ovako će vas kupci kontaktirati)</label>
                    <input type="text" class="form-control" id="phone" name="phone" >
                    <div class="form-text text-danger"></div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Lozinka</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="form-text text-danger"></div>
                </div>

                <div class="mb-3">
                    <label for="passwordConfirm" class="form-label">Potvrdi lozinku</label>
                    <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm">
                    <div class="form-text text-danger"></div>
                </div>

                <button id="registerBtn" type="button" class="btn btn-primary">Registrujte se</button>
            </form>
            <hr />
            <p class="mt-3 text-secondary">Imate nalog? <a href="index.php?page=login">Ulogujte se ovde.</a></p>
        </div>
    </div>
</div>
<script src="assets/js/authorization.js"></script>
