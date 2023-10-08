
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
                <h2 class="fw-bold fs-1 mb-4">Rezultati Anekete</h2>

                <?php
                if($votes = getPollResults()):
                    ?>
                    <table class="table text-light table-stripped mt-4">
                        <thead>
                        <tr>
                            <th scope="col">Država</th>
                            <th scope="col">Broj Glasova</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($votes as $v):
                            ?>
                            <tr>
                                <td><?=$v->country_name?></td>
                                <td><?=$v->votes?></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>

                        </tbody>
                    </table>
                <?php
                else:
                    ?>
                    <div class="alert alert-info" role="alert">
                        Nema glasova.
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