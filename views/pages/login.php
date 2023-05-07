<div class="container my-5">
    <div class="row">
        <div class="col-12 col-lg-5 mx-auto d-block">

            <div class="alert alert-info alert-animation mb-4" role="alert" id="loginAlert" style="display: none">

            </div>

            <h2 class="fw-bold">Ulogujte se</h2>
            <hr />
            <form>
                <div class="mb-3">
                    <label for="email" class="form-label">Email adresa</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    <div class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Lozinka</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="form-text text-danger"></div>
                </div>

                <button type="button" id="loginBtn" class="btn btn-primary">Potvrdi</button>
            </form>
            <hr />
            <p class="mt-3 text-secondary">Nemate nalog? <a href="index.php?page=register">Registrujte se ovde.</a></p>
        </div>
    </div>
</div>

<script src="assets/js/authorization.js"></script>