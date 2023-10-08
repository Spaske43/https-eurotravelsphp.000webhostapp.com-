<?php

$offerID = 0;
if(isset($_GET['id'])){
    $offerID = $_GET['id'];
}

if($offerID == 0):
    ?>
    <div class="container my-5">
        <div class="alert alert-danger" role="alert">
            Ne možete pristupiti ovoj stranici! <br />
            <button type="button" class="btn btn-secondary">
                <a href="index.php?page=Ponude">Nazad na ponude <i class="fa-solid fa-arrow-right-long"></i></a>
            </button>
        </div>
    </div>
<?php
elseif($offer = getOffer($offerID)):
    $dates = getStartDates($offerID);
    ?>

    <!--MODAL-->
    <div class="modal" id="reservation-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Napravite Rezervaciju</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!--                MODAL FORM-->
                <div class="modal-body">

                    <!--                    ALERT-->
                    <div class="alert alert-warning" role="alert" id="make-reservation-alert">

                    </div>

                    <form>
                        <div class="mb-3">
                            <label for="date_start" class="form-label">Datum polaska</label>
                            <select class="form-select" id="date_start" name="date_start">
                                <?php
                                foreach ($dates as $d):
                                    ?>
                                    <option value="<?=$d->id?>"><?=date('j.n.Y',strtotime($d->date_start))?></option>
                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="people" class="form-label">Broj osoba</label>
                            <select class="form-select" id="people" name="people" data-price="<?=$offer->price?>">
                                <?php
                                for($i = 1; $i < 10; $i++):
                                    ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                <?php
                                endfor;
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ukupna cena</label>
                            <h5 id="total-price"><?=$offer->price?> €</h5>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Poništi</button>
                    <button id="make-reservation" data-offerid="<?=$offer->id?>" type="button" class="btn btn-primary">Rezerviši</button>
                </div>
            </div>
        </div>
    </div>

    <!--OFFER CONTENT-->
    <div class="container my-5">
        <div class="card">
            <img src="<?=$offer->image_url?>" class="card-img-top" alt="<?=$offer->offer_name?>">
            <div class="card-body">
                <h5 class="card-title fw-bold fs-3"><?=$offer->offer_name?></h5>
                <p class="card-text text-primary"><?=$offer->country_name?> / <?=$offer->location?></p>
                <p class="card-text"><?=$offer->description?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Cena po osobi: <?=$offer->price?> &euro;</li>
                <li class="list-group-item">Trajanje: <?=$offer->length?> dana</li>
                <li class="list-group-item">Datumi polaska:
                    <?php
                    if(count($dates) > 0):
                        ?>
                        <ul>
                            <?php
                            foreach ($dates as $d):
                                ?>
                                <li><?=date('j.n.Y',strtotime($d->date_start))?></li>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    <?php
                    else:
                        ?>
                        <br />
                        Trenutno nema polazaka
                    <?php
                    endif;
                    ?>
                </li>
            </ul>
            <div class="card-body">

                <div class="row">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <?php
                        if(isset($_SESSION['user'])):
                            ?>
                            <button type="button" id="open-reservation-modal" class="btn btn-primary">Napravite rezervaciju</button>
                        <?php
                        else:
                            ?>
                            <p class="card-text text-primary">Ulogujte se da bi ste rezervisali putovanje.</p>
                        <?php
                        endif;
                        ?>
                    </div>

                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <a href="index.php?page=Ponude" class="card-link">
                            <button type="button" class="btn btn-outline-danger"><i class="fa-solid fa-arrow-left"></i> Nazad na ponude</button>
                        </a>
                    </div>

                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <?php
                        if(isset($_SESSION['user']) && $_SESSION['user']->role_name === "Admin"):
                            ?>
                        <a href="models/offers/delete.php?id=<?=$offer->id?>&route=offers">
                            <button type="button" data-id="<?=$offer->id?>" id="delete-reservation" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> Izbriši ponudu</button>
                        </a>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
else:
    ?>
    <div class="container my-5">
        <div class="alert alert-danger" role="alert">
            Ova ponuda ne postoji! <br />
            <button type="button" class="btn btn-secondary mt-3">
                <a href="index.php?page=Ponude" class="text-light">Nazad na ponude <i class="fa-solid fa-arrow-right-long"></i></a>
            </button>
        </div>
    </div>
<?php
endif;



?>
    <script src="assets/js/offer.js"></script>
