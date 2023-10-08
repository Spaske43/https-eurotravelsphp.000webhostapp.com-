<?php


$pageNumber = 1;
if(isset($_GET['strana'])){
    $pageNumber = $_GET['strana'];
}
$users = getUsers($pageNumber,10);
$userCount = getUserCount();
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
                <h2 class="fw-bold fs-1">Korisnici</h2>

                <?php
                if(count($users) > 0):
                    ?>
                    <table class="table text-light table-stripped mt-4">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Kor. Ime</th>
                            <th scope="col">Email adresa</th>
                            <th scope="col">Telefon</th>
                            <th scope="col">Uloga</th>
                            <th scope="col">Vreme Reg.</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($users as $u):
                            ?>
                            <tr>
                                <th scope="row"><?=$u->id?></th>
                                <td><?=$u->username?></td>
                                <td><?=$u->email?></td>
                                <td><?=$u->phone?></td>
                                <td><?=$u->role_name?></td>
                                <td><?=$u->reg_date?></td>

                                <td><a href="index.php?page=editUsers&&id=<?=$u->id?>">
                                        <button type="button
                                        "  class="btn btn-info text-light">Izmeni</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="models/user/delete.php?id=<?=$u->id?>">
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
                    if($userCount->count > 10):
                        ?>
                        <nav class="mx-auto my-5 d-block" style="width: fit-content">
                            <ul class="pagination">
                                <?php
                                for($i = 0; $i < ceil($userCount->count/10); $i++):
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