
<body>
<?php
if(isset($_SESSION['user']) && $_SESSION['user']->role_name == "Admin"):
?>
    <div class="container-fluid bg-dark text-light" id="admin-wrapper">
        <div class="row py-3">
            <div class="col-2">
                <?php
                include('views/fixed/navAdmin.php');
                $offers = getAllOffers();
                $users = getAllUsers();
                ?>
            </div>

            <div class="col-10 px-5 border-start ">
                <h2 class="fw-bold fs-1">Rezervacije</h2>

                <?php
                if($reservations = getAllReservations()):
                    ?>
                    <table class="table text-light table-stripped mt-4">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Destinacija</th>
                            <th scope="col">Klijent</th>
                            <th scope="col">Datum Polaska</th>
                            <th scope="col">Broj Osoba</th>
                            <th scope="col">Ukupna Cena</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($reservations as $r):
                            ?>
                            <tr>
                                <th scope="row"><?=$r->id?></th>
                                <td><?=$r->offer_name?></td>
                                <td><?=$r->username?></td>
                                <td><?=$r->date_start?></td>
                                <td><?=$r->people?></td>
                                <td><?=$r->price * $r->people?> &euro;</td>
                                <td><a href="index.php?page=editReservation&&id=<?=$r->id?>">
                                        <button type="button"  class="btn btn-info text-light">
                                            Izmeni</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="models/reservations/delete.php?id=<?=$r->id?>&admin=true">
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


                    <h3 class="text-light fw-bold mt-5 mb-4">Dodaj Rezervaciju</h3>

                    <div class="row">
                        <div class="col-6">
                            <form>

                                <!--                           PONUDA-->
                                <div class="mb-3">
                                    <label for="offerID" class="form-label">Ponuda</label>
                                    <select class="form-select" id="offerID" name="offerID">
                                        <option selected value="0">Izaberite ponudu</option>
                                        <?php
                                        foreach ($offers as $o):
                                            ?>
                                            <option value="<?=$o->id?>"><?=$o->offer_name?></option>
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
                                            <option value="<?=$u->id?>"><?=$u->username?></option>
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
                                            <option value="<?=$i?>"><?=$i?></option>
                                        <?php
                                        endfor;
                                        ?>
                                    </select>
                                </div>

                                <!--                           DATUM-->
                                <div class="mb-3">
                                    <label for="dateID" class="form-label">Datum polaska</label>
                                    <select class="form-select" id="dateID" name="dateID">
                                        <option selected value="0">Morate prvo izabrati ponudu</option>
                                    </select>
                                    <small class="text-danger"></small>
                                </div>


                                <button type="button" id="add-reservation-btn" class="btn btn-primary px-5 mt-3">Dodaj</button>
                            </form>

                            <div class="alert alert-secondary user-alert mt-4" role="alert" id="reservation-alert">

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
