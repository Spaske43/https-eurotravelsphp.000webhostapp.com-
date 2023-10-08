
<body>
<?php
if(isset($_GET['id']) && isset($_SESSION['user']) && $_SESSION['user']->role_name == "Admin"
 &&  $offer = getOffer($_GET['id'])):
    ?>
    <div class="container-fluid bg-dark text-light" id="admin-wrapper">
        <div class="row py-3">
            <div class="col-2">
                <?php
                include('views/fixed/navAdmin.php');
                ?>
            </div>

            <div class="col-10 px-5 border-start ">
                <h2 class="fw-bold fs-1 mb-4">Izmeni rezervaciju</h2>
                <div class="row">
                    <div class="col-6">
                        <form>
                            <!--                           NAZIV PONUDE-->
                            <div class="mb-3">
                                <label for="offer_name" class="form-label">Naziv</label>
                                <input type="text" value="<?=$offer->offer_name?>"
                                 class="form-control" id="offer_name" name="offer_name">
                                <small class="text-danger"></small>
                            </div>

                            <!--                           DRZAVA -->
                            <div class="mb-3">
                                <label for="countryID" class="form-label">Država</label>
                                <select class="form-select" id="countryID" name="countryID">
                                    <option value="0">Izaberite državu</option>
                                    <?php
                                    $countries = getAllCountries();
                                    foreach ($countries as $c):
                                        ?>
                                        <option
                                            <?php
                                            if($c->country_name === $offer->country_name){
                                                echo 'selected';
                                            }
                                            ?>
                                            value="<?=$c->id?>"><?=$c->country_name?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <small class="text-danger"></small>
                            </div>

                            <!--                           LOKACIJA-->
                            <div class="mb-3">
                                <label for="location" class="form-label">Lokacija</label>
                                <input type="text" value="<?=$offer->location?>" class="form-control"
                                 id="location" name="location">
                                <small class="text-danger"></small>
                            </div>

                            <!--                           SLIKA-->
                            <div class="mb-3">
                                <label for="image_url" class="form-label">URL Fotografije</label>
                                <input type="text" value="<?=$offer->image_url?>" class="form-control"
                                 id="image_url" name="image_url">
                                <small class="text-danger"></small>
                            </div>

                            <!--                           CENA-->
                            <div class="mb-3">
                                <label for="price" class="form-label">Cena po osobi (&euro;)</label>
                                <input type="number" value="<?=$offer->price?>" class="form-control"
                                 id="price" name="price">
                                <small class="text-danger"></small>
                            </div>

                            <!--                            TRAJANJE-->
                            <div class="mb-3">
                                <label for="length" class="form-label">Broj dana</label>
                                <input type="number" value="<?=$offer->length?>" class="form-control"
                                 id="length" name="length">
                                <small class="text-danger"></small>
                            </div>

                            <!--                            OPIS-->
                            <div class="mb-3">
                                <label for="description" class="form-label">Opis</label>
                                <textarea class="form-control"  name="description" id="description"
                                 rows="5"><?=$offer->description?></textarea>
                                <small class="text-danger"></small>
                            </div>

                            <!--                           DATUM-->
                            <div class="mb-3">
                                <p class="text-light">* Dodajte novi datum polaska
                                     ili ih obrišite u sekciji Datumi polaska</p>
                            </div>

<!--                            ID PONUDE-->
                            <input name="id" id="id" type="hidden" value="<?=$offer->id?>"/>
                            <small class="text-danger"></small>

                            <button type="button" id="edit-offer-btn"
                             class="btn btn-primary px-5 mt-3">Izmeni</button>

                        </form>

                        <div class="alert alert-secondary user-alert mt-4"
                         role="alert" id="offer-alert">

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
