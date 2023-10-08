
<body>
<?php
if(isset($_GET['id']) && isset($_SESSION['user']) && $_SESSION['user']->role_name == "Admin" 
&&  $country = getCountry($_GET['id'])):
    ?>
    <div class="container-fluid bg-dark text-light" id="admin-wrapper">
        <div class="row py-3">
            <div class="col-2">
                <?php
                include('views/fixed/navAdmin.php');
                ?>
            </div>

            <div class="col-10 px-5 border-start ">
                <h2 class="fw-bold fs-1 mb-4">Izmeni državu</h2>
                <div class="row">
                    <div class="col-6">
                        <form>
                            <!--                           NAZIV DRZAVE-->
                            <div class="mb-3">
                                <label for="country_name" class="form-label">Naziv</label>
                                <input type="text" value="<?=$country->country_name?>"
                                 class="form-control" id="country_name" name="country_name">
                                <small class="text-danger"></small>
                            </div>

                            <!--                           SLIKA-->
                            <div class="mb-3">
                                <label for="flag_url" class="form-label">URL Fotografije</label>
                                <input type="text" value="<?=$country->flag_url?>"
                                 class="form-control" id="flag_url" name="flag_url">
                                <small class="text-danger"></small>
                            </div>

                            <!--                            ID DRZAVE-->
                            <input name="id" id="id" type="hidden" value="<?=$country->id?>"/>
                            <small class="text-danger"></small>

                            <button type="button" id="edit-country-btn"
                             class="btn btn-primary px-5 mt-3">Izmeni</button>
                        </form>

                        <div class="alert alert-secondary user-alert mt-4"
                         role="alert" id="country-alert">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/edit.js"></script>
<?php
else:
?>
    <div class="container mt-5">
        <div class="alert alert-danger" role="alert">
            Nemate pravo pristupa.
        </div>
    </div>
<?php
endif;
?>

