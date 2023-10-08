<?php

$pageNumber = 1;
$sort = "DESC";
if(isset($_GET['strana'])){
    $pageNumber = $_GET['strana'];
}

$dateCount = getDatesCount();
$offers = getAllOffers();
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
                <h2 class="fw-bold fs-1">Datumi Polaska</h2>

                <?php
                if($dates = getAllDates($pageNumber, 10)):
                    ?>
                    <table class="table text-light table-stripped mt-4">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Datum</th>
                            <th scope="col">Ponuda</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($dates as $d):
                            ?>
                            <tr>
                                <th scope="row"><?=$d->id?></th>
                                <td><?=$d->date_start?></td>
                                <td><?=$d->offer_name?></td>
                                <td>
                                    <a href="models/dates/delete.php?id=<?=$d->id?>">
                                        <button type="button" class="btn btn-danger">
                                            Izbriši</button>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>

                        </tbody>
                    </table>

                    <!--            PAGIANCIJA-->
                    <?php
                    if($dateCount->count > 10):
                        ?>
                        <nav class="mx-auto my-5 d-block" style="width: fit-content">
                            <ul class="pagination">
                                <?php
                                for($i = 0; $i < ceil($dateCount->count/10); $i++):
                                    ?>
                                    <li class="page-item <?=$i+1 == $pageNumber ? "active" : ""?>">
                                    <a class="page-link" href="index.php?page=adminStartDates&&strana=<?=$i+1?>">
                                    <?=$i+1?></a></li>
                                <?php
                                endfor;
                                ?>
                            </ul>
                        </nav>
                    <?php
                    endif;
                    ?>

                    <h3 class="text-light fw-bold mt-5 mb-4">Dodaj Datum Polaska</h3>

                    <div class="row">
                        <div class="col-6 mb-5">
                            <form>
                                <!--                            PONUDA-->
                                <div class="mb-3">
                                    <label for="offer" class="form-label">Ponuda</label>
                                    <select class="form-select" id="offer" name="offer">
                                        <option value="0" selected>Izaberite ponudu</option>
                                        <?php
                                        foreach($offers as $o):
                                            ?>
                                            <option value="<?=$o->id?>"><?=$o->offer_name?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>
                                    <small class="text-danger"></small>
                                </div>

                                <!--                           DATUM-->
                                <div class="mb-3">
                                    <label for="date" class="form-label">Datum polaska</label>
                                    <input type="date" class="form-select" id="date" name="date" >
                                    <small class="text-danger"></small>
                                </div>

                                <button type="button" id="add-date-btn"
                                 class="btn btn-primary px-5 mt-3">Dodaj</button>
                            </form>

                            <div class="alert alert-secondary user-alert mt-4 mb-5"
                             role="alert" id="date-alert">

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
