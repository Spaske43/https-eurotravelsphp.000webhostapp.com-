<body>
<?php
if(isset($_SESSION['user']) && $_SESSION['user']->role_name == "Admin"):
?>
    <div class="container-fluid bg-dark text-light" id="admin-wrapper">
        <div class="row py-3">
            <div class="col-2">
                <?php
                include('views/fixed/navAdmin.php');
                ?>
            </div>
            <div class="col-10 px-5 border-start ">
                <h2 class="fw-bold fs-1">Države</h2>

                <?php
                if($countries = getAllCountries()):
                    ?>
                    <table class="table text-light table-stripped mt-4">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Naziv</th>
                            <th scope="col">Zastava</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($countries as $c):
                            ?>
                            <tr>
                                <th scope="row"><?=$c->id?></th>
                                <td><?=$c->country_name?></td>
                                <td><img src="<?=$c->flag_url?>" width="80px" 
                                height="40px" alt="<?=$c->country_name?>"/></td>
                                <td><a href="index.php?page=editCountry&&id=<?=$c->id?>">
                                        <button type="button"  class="btn btn-info text-light">
                                            Izmeni</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="models/countries/delete.php?id=<?=$c->id?>">
                                        <button type="button" class="btn btn-danger">Izbriši</button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>

                        </tbody>
                    </table>

                    <h3 class="text-light fw-bold mt-5 mb-4">Dodaj Državu</h3>

                    <div class="row">
                        <div class="col-6">
                            <form>

                                <!--                           NAZIV DRZAVE-->
                                <div class="mb-3">
                                    <label for="country_name" class="form-label">Naziv</label>
                                    <input type="text" class="form-control" id="country_name" name="country_name">
                                    <small class="text-danger"></small>
                                </div>

                                <!--                           SLIKA-->
                                <div class="mb-3">
                                    <label for="flag_url" class="form-label">URL Fotografije</label>
                                    <input type="text" class="form-control" id="flag_url" name="flag_url">
                                    <small class="text-danger"></small>
                                </div>

                                <button type="button" id="add-country-btn" class="btn btn-primary px-5 mt-3">Dodaj</button>
                            </form>

                            <div class="alert alert-secondary user-alert mt-4" role="alert" id="country-alert">

                            </div>
                        </div>
                    </div>
                <?php
                else:
                    ?>
                    <div class="alert alert-info" role="alert">
                        Nema rezervacija.
                    </div>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
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

<script src="assets/js/edit.js"></script>