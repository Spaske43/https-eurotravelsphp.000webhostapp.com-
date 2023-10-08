<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <div class="container-fluid">
            <a class="navbar-brand fs-2" id="logo" href="index.php">
                <i class="fa-regular fa-compass"></i> Euro Travel</a>
            <button class="navbar-toggler" type="button"
             data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <?php

                        $links = getAllLinks();

                        foreach ($links as $link):
                    ?>
                        <li class="nav-item">
                            <a class="nav-link active"  href="index.php?page=<?=$link->name?>"><?=$link->name?></a>
                        </li>
                    <?php
                        endforeach;
                    ?>
                <!--  LOGIN / LOGOUT DUGME-->
                    <?php
                        if (isset($_SESSION['user'])):
                    ?>
                            <li class="nav-item">
                                <a class="nav-link active"  href="index.php?page=Rezervacije">Moje Rezervacije</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active"  href="models/user/logout.php">
                                    <button type="button" class="btn btn-outline-danger">Odjava</button>
                                </a>
                            </li>
                    <?php
                        else:
                    ?>
                            <li class="nav-item">
                                <a class="nav-link active"  href="index.php?page=login">
                                    <button type="button" class="btn btn-info text-light">Prijava</button>
                                </a>
                            </li>
                    <?php
                        endif;
                    ?>

                    <!--  ADMIN DUGME-->
                    <?php
                    if (isset($_SESSION['user']) && $_SESSION['user']->role_name == "Admin"):
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active"  href="index.php?page=adminReservations">
                                <button type="button" class="btn btn-info text-light">Admin Panel</button>
                            </a>
                        </li>
                    <?php
                    endif;
                    ?>
                </ul>
            </div>
        </div>
    </nav>

