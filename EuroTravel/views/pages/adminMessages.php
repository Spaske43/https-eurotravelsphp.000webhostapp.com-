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
                <h2 class="fw-bold fs-1 mb-4">Poruke</h2>

                <?php
                if($messages = getAllMessages()):
                    ?>
                    <div class="row">

                        <?php
                        foreach ($messages as $m):
                            ?>
                            <div class="col-12 col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title text-dark fw-bold"><?=$m->subject?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted"><?=$m->date?></h6>
                                        <p class="card-text text-secondary"><?=$m->body?></p>
                                        <a href="models/contact/delete.php?id=<?=$m->id?>"
                                         class="card-link btn btn-danger">Obriši</a>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach;
                        ?>
                    </div>
                <?php
                else:
                    ?>
                    <div class="alert alert-info" role="alert">
                        Nema poruka.
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
