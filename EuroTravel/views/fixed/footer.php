<footer class="container-fluid bg-dark text-light py-4 ">
    <ul class="navbar-nav align-items-center
     d-flex flex-wrap flex-row align-items-center justify-content-center">
        <?php

        $links = getAllLinks();

        foreach ($links as $link):
            ?>
            <li class="nav-item mx-3 hover">
                <a class="nav-link active text-light"
                  href="index.php?page=<?=$link->name?>"><?=$link->name?></a>
            </li>
        <?php
        endforeach;
        ?>
        <!--  LOGIN / LOGOUT DUGME-->
        <?php
        if (isset($_SESSION['user'])):
            ?>
            <li class="nav-item mx-3 hover">
                <a class="nav-link active text-light"  href="index.php?page=rezervacije">Moje Rezervacije</a>
            </li>
        <?php
        endif;
        ?>
        <li class="nav-item mx-3 hover">
            <a class="nav-link active text-light"  href="Dokumentacija.pdf" target="_blank">Dokumentacija</a>
        </li>
        
        <li class="nav-item mx-3 hover">
            <a class="nav-link active text-light"  href="sitemap.xml" target="_blank">Sitemap</a>
        </li>

    </ul>

    <hr />

    <h5 class="text-center">EuroTravel&copy; Agencija</h5>
</footer>
</body>

</html>