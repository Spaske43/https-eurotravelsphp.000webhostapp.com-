<?php


$pageNumber = 1;
$sort = "DESC";
if(isset($_GET['strana'])){
    $pageNumber = $_GET['strana'];
}

if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
}

$offers = getOffers($pageNumber, $sort,6);
$offerCount = getOfferCount();
?>

<div class="container my-5">
<!--    PRETRAGA I SORTIRANJE  -->

    <div class="row my-5">
        <div class="col-12 col-md-6">
            <div class="input-group position-relative">
                <input type="text" id="search-term" class="form-control"
                 placeholder="Pretraži po imenu ili državi">
                <span class="input-group-text bg-primary text-light" id="search-button">
                    <button class="btn btn-primary px-4">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </span>

                <div id="search-results"  style="top: 39px;">
                    <ul id="search-results-list" class="list-group">

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-0 col-md-4"></div>

        <div class="col-12 col-md-2 mt-3 mt-md-0 d-flex align-items-center
         justify-content-end">
            <div class="dropdown me-0 me-md-4">
                <a class="btn btn-outline-dark dropdown-toggle" href="#"
                 role="button" id="dropdownMenuLink" data-bs-toggle="dropdown">
                    <?=$sort == "DESC" ? "Cena opadajuće" : "Cena rastuće"?>
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="index.php?page=Ponude&&sort=DESC">
                        Cena opadajuće</a></li>
                    <li><a class="dropdown-item" href="index.php?page=Ponude&&sort=ASC">
                        Cena rastuće</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <?php
        foreach ($offers as $offer):
        ?>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card">
                    <img src="<?=$offer->image_url?>" class="card-img-top"
                     style="height: 300px;" alt="<?=$offer->offer_name?>">
                    <div class="card-body">
                        <h5 class="card-title fw-bold"><?=$offer->offer_name?></h5>
                        <p class="card-text text-primary"><?=$offer->country_name?>
                        /
                         <?=$offer->location?></p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Cena po osobi: <?=$offer->price?> &euro;</li>
                        <li class="list-group-item">Trajanje: <?=$offer->length?> dana</li>

                    </ul>
                    <div class="card-body">
                        <a href="index.php?page=ponuda&&id=<?=$offer->id?>" class="card-link">
                            <button class="offer-info-link text-light">
                                Saznaj više <i class="fa-solid fa-arrow-right-long"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>

    <?php
    if($offerCount->count > 6):
    ?>
        <nav class="mx-auto my-5 d-block" style="width: fit-content">
            <ul class="pagination">
                <?php
                for($i = 0; $i < ceil($offerCount->count/6); $i++):
                ?>
                    <li class="page-item <?=$i+1 == $pageNumber ? "active" : ""?>">
                    <a class="page-link" href="index.php?page=Ponude&&strana=<?=$i+1?>&sort=<?=$sort?>">
                    <?=$i+1?></a></li>
                <?php
                endfor;
                ?>
            </ul>
        </nav>
    <?php
    endif;
    ?>
</div>
