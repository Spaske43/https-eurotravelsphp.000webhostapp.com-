

<?php
if(isset($_SESSION['user'])):
?>
<div class="container py-5 mb-5">

    <div class="row justify-content-center mb-3">
        <div class="col-12 col-lg-6">
            <div class="alert alert-info user-alert text-center" role="alert" id="contact-alert">

            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 bg-dark text-light p-4 rounded">
            <form>
                <div class="mb-3">
                    <label for="subject" class="form-label">Naslov</label>
                    <input type="text" class="form-control" id="subject" name="subject">
                    <small class="text-danger"></small>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Vaša poruka</label>
                    <textarea class="form-control" name="body" id="body" rows="5"></textarea>
                    <small class="text-danger"></small>
                </div>

                <button type="button" id="contact-btn" class="btn btn-primary px-5 mx-auto d-block">Pošalji</button>
            </form>
        </div>
    </div>
</div>

<script src="assets/js/contact.js"></script>
<?php
else:
?>
    <div class="container py-5">

    <div class="row justify-content-center mb-3">
        <div class="col-12 col-lg-6">
            <div class="alert alert-info text-center" role="alert" >
                Ulogujte se da bi ste nas kontaktirali. <br />
                <a href="index.php?page=login" class="btn btn-primary mt-3">Ulogujte se</a>
            </div>
        </div>
    </div>

    </div>
    
<?php
endif;
?>
    <script src="assets/js/contact.js"></script>



