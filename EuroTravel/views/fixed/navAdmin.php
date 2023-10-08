<nav class="px-3">

    <h1 class="fs-3 fw-bold">Admin Panel</h1>
    <hr />
    <ul class="navbar-nav d-flex flex-column">

        <?php

        $links = getAllAdminLinks();

        foreach ($links as $link):
        ?>
            <li class="nav-item">
                <a class="nav-link  text-light"  href="index.php?page=<?=$link->name?>"><?=$link->name?></a>
            </li>
        <?php
        endforeach;
        ?>
        <li class="nav-item">
            <a class="nav-link btn btn-outline-danger text-light" href="index.php?page=Ponude">Nazad na sajt</a>
        </li>
    </ul>
</nav>



