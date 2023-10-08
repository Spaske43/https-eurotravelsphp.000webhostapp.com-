<?php

$pageNumber = 1;
$sort = "DESC";
if(isset($_GET['strana'])){
    $pageNumber = $_GET['strana'];
}

if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
}

$offers = getOffers($pageNumber, $sort,10);
$offerCount = getOfferCount();
?>
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
                <h2 class="fw-bold fs-1">Ponude</h2>

                <?php
                if(count($offers) > 0):
                    ?>
                    <table class="table text-light table-stripped mt-4">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Naziv</th>
                            <th scope="col">Država</th>
                            <th scope="col">Cena Po Osobi</th>
                            <th scope="col">Trajanje</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($offers as $o):
                            ?>
                            <tr>
                                <th scope="row"><?=$o->id?></th>
                                <td><?=$o->offer_name?></td>
                                <td><?=$o->country_name?></td>
                                <td><?=$o->price?> &euro;</td>
                                <td><?=$o->length?> dana</td>
                                <td><a href="index.php?page=editOffer&&id=<?=$o->id?>">
                                        <button type="button"  class="btn btn-info text-light">Izmeni</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="models/offers/delete.php?id=<?=$o->id?>&route=admin">
                                        <button type="button" class="btn btn-danger">Izbriši</button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>

                    <?php
                    if($offerCount->count > 10):
                        ?>
                        <nav class="mx-auto my-5 d-block" style="width: fit-content">
                            <ul class="pagination">
                                <?php
                                for($i = 0; $i < ceil($offerCount->count/10); $i++):
                                    ?>
                                    <li class="page-item <?=$i+1 == $pageNumber ? "active" : ""?>">
                                    <a class="page-link" href="index.php?page=adminOffers&&strana=<?=$i+1?>">
                                    <?=$i+1?></a></li>
                                <?php
                                endfor;
                                ?>
                            </ul>
                        </nav>
                    <?php
                    endif;
                    ?>

                    <!--            DODAJ PONUDU-->
                    <h3 class="text-light fw-bold mt-5 mb-4">Dodaj Ponudu</h3>

                    <div class="row">
                        <div class="col-6">
                            <form>

                                <!--                           NAZIV PONUDE-->
                                <div class="mb-3">
                                    <label for="offer_name" class="form-label">Naziv</label>
                                    <input type="text" class="form-control" id="offer_name" name="offer_name">
                                    <small class="text-danger"></small>
                                </div>

                                <!--                           DRZAVA -->
                                <div class="mb-3">
                                    <label for="countryID" class="form-label">Država</label>
                                    <select class="form-select" id="countryID" name="countryID">
                                        <option selected value="0">Izaberite državu</option>
                                        <?php
                                        $countries = getAllCountries();
                                        foreach ($countries as $c):
                                            ?>
                                            <option value="<?=$c->id?>"><?=$c->country_name?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                    <small class="text-danger"></small>
                                </div>

                                <!--                           LOKACIJA-->
                                <div class="mb-3">
                                    <label for="location" class="form-label">Lokacija</label>
                                    <input type="text" class="form-control" id="location" name="location">
                                    <small class="text-danger"></small>
                                </div>

                                <!--                           SLIKA-->
                                <div class="mb-3">
                                    <label for="image_url" class="form-label">URL Fotografije</label>
                                    <input type="text" class="form-control" id="image_url" name="image_url">
                                    <small class="text-danger"></small>
                                </div>

                                <!--                           CENA-->
                                <div class="mb-3">
                                    <label for="price" class="form-label">Cena po osobi (&euro;)</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                    <small class="text-danger"></small>
                                </div>

                                <!--                            TRAJANJE-->
                                <div class="mb-3">
                                    <label for="length" class="form-label">Broj dana</label>
                                    <input type="number" class="form-control" id="length" name="length">
                                    <small class="text-danger"></small>
                                </div>

                                <!--                            OPIS-->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Opis</label>
                                    <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                                    <small class="text-danger"></small>
                                </div>

                                <!--                           DATUM-->
                                <div class="mb-3">
                                    <label for="date" class="form-label">Datum polaska</label>
                                    <input type="date" class="form-select" id="date" name="date" >
                                    <small class="text-danger"></small>
                                </div>


                                <button type="button" id="add-offer-btn" class="btn btn-primary px-5 mt-3">Dodaj</button>
                            </form>

                            <div class="alert alert-secondary user-alert mt-4" role="alert" id="offer-alert">

                            </div>
                        </div>
                    </div>
                <?php
                else:
                    ?>
                    <div class="alert alert-info" role="alert">
                        Nema ponuda.
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