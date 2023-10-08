<?php


if(isset($_SESSION['user'])):
    $reservations = getUserReservations($_SESSION['user']->id);
?>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-9 p-4">
                <h2 class="fw-bold">Moje Rezervacije</h2>
                <hr/>
                <div class="container  py-1">
                    <div class="row">
                        <?php
                        if(count($reservations) > 0):
                        ?>

                            <?php
                            foreach ($reservations as $res):
                            ?>
                                <div class="col-12 col-md-6 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            Rezervisano: <?=date('j.n.Y',strtotime($res->date_reserved))?>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title"><?=$res->location?> / <?=$res->country_name?></h5>
                                            <p class="card-text">
                                            <ul class="list-group">
                                                <li class="list-group-item">Broj osoba: <?=$res->people?></li>
                                                <li class="list-group-item">Ukupna cena: <?=$res->price?> &euro;</li>
                                                <li class="list-group-item">Datum polaska: <?=date('j.n.Y',strtotime($res->date_start))?></li>
                                            </ul>
                                            </p>
                                            <a href="models/reservations/delete.php?id=<?=$res->id?>" class="btn btn-danger"><i class="fa-regular fa-trash-can"></i> Otkaži rezervaciju</a>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else:
                        ?>
                            <div class="alert alert-dark" role="alert">
                                Nemate ni jednu rezervaciju.
                            </div>
                            <button type="button" class="btn btn-secondary mt-3">
                <a class="text-light" href="index.php?page=Ponude">Nazad na ponude <i class="fa-solid fa-arrow-right-long"></i></a>
            </button>
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
            Ne možete pristupiti ovoj stranici! <br />
            <button type="button" class="btn btn-secondary mt-3">
                <a class="text-light" href="index.php?page=Ponude">Nazad na ponude <i class="fa-solid fa-arrow-right-long"></i></a>
            </button>
        </div>
    </div>
<?php
endif;
?>