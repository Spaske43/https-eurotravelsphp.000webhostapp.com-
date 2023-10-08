
<body>
<?php
if(isset($_GET['id']) && isset($_SESSION['user']) && $_SESSION['user']->role_name == "Admin"):
?>
    <div class="container-fluid bg-dark text-light" id="admin-wrapper">
        <div class="row py-3">
            <div class="col-2">
                <?php
                include('views/fixed/navAdmin.php');
                $offers = getAllOffers();
                $users = getAllUsers();
                $res = getReservation($_GET['id']);
                $dates = getStartDates($res->id_offer);
                ?>
            </div>

            <div class="col-10 px-5 border-start ">
                <h2 class="fw-bold fs-1 mb-4">Izmeni rezervaciju</h2>
                <div class="row">
                    <div class="col-6">
                        <form>

                            <!--                           PONUDA-->
                            <div class="mb-3">
                                <label for="offerID" class="form-label">Ponuda</label>
                                <select class="form-select" id="offerID" name="offerID">
                                    <option value="0">Izaberite ponudu</option>
                                    <?php
                                    foreach ($offers as $o):
                                        ?>
                                        <option
                                            <?php
                                            if($o->id == $res->id_offer){
                                                echo 'selected';
                                            }
                                            ?>
                                            value="<?=$o->id?>"><?=$o->offer_name?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <small class="text-danger"></small>
                            </div>

                            <!--                           KORISNIK-->
                            <div class="mb-3">
                                <label for="userID" class="form-label">Klijent</label>
                                <select class="form-select" id="userID" name="userID">
                                    <option selected value="0">Izaberite klijenta</option>
                                    <?php
                                    foreach ($users as $u):
                                        ?>
                                        <option
                                            <?php
                                            if($u->id == $res->id_user){
                                                echo 'selected';
                                            }
                                            ?>
                                            value="<?=$u->id?>"><?=$u->username?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <small class="text-danger"></small>
                            </div>

                            <!--                           BROJ OSOBA-->
                            <div class="mb-3">
                                <label for="people" class="form-label">Broj osoba</label>
                                <select class="form-select" id="people" name="people">
                                    <?php
                                    for($i = 1; $i < 10; $i++):
                                        ?>
                                        <option
                                            <?php
                                            if($res->people == $i){
                                                echo 'selected';
                                            }
                                            ?>
                                            value="<?=$i?>"><?=$i?></option>
                                    <?php
                                    endfor;
                                    ?>
                                </select>
                            </div>

                            <!--                           DATUM-->
                            <div class="mb-3">
                                <label for="dateID" class="form-label">Datum polaska</label>
                                <select class="form-select" id="dateID" name="dateID">
                                    <?php
                                    foreach ($dates as $d):
                                    ?>
                                        <option value="<?=$d->id?>"><?=$d->date_start?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <small class="text-danger"></small>
                            </div>

<!--                            ID REZERVACIJE-->
                            <input name="id" id="id" type="hidden" value="<?=$res->id?>"/>
                            <small class="text-danger"></small>

                            <button type="button" id="edit-reservation-btn" class="btn btn-primary px-5 mt-3">Izmeni</button>
                        </form>

                        <div class="alert alert-secondary user-alert mt-4" role="alert" id="reservation-alert">

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
