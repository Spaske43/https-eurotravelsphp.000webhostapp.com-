<?php
 $countries = getAllCountries();
?>

<div class="container-fluid" id="homepage-image">
    <div class="text-center" >
        <h3 class="text-light mb-2">Istražite Evropu sa nama!</h3>
        <p >Dobrodošli na EuroTravel! Istražite najveću ponudu turističkih
             aranžmana u Srbiji. Ukoliko je vaš san da obiđete Evropu,
              na pravom ste mestu. Kliknite na link ispod da biste započel
               vašu avanturu!</p>
        <a href="index.php?page=Ponude" class="fs-4 btn btn-outline-warning">Sve Ponude
             <i class="fa-solid fa-arrow-right-long"></i></a>

    </div>
</div>

<div class="container py-5">
    <h2 class="fw-bold text-center">Koja je vaša omiljena destinacija?</h2>
    <hr />

    <form>
        <div class="row mt-4">
            <?php
            foreach ($countries as $country):
                ?>
                <div class="col-12 col-md-4 d-flex flex-row
                 align-items-center justify-content-between mb-3 border py-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio"
                         value="<?=$country->id?>" name="country">
                        <label class="form-check-label" for="country">
                            <?=$country->country_name?>

                        </label>
                    </div>

                    <img src="<?=$country->flag_url?>"
                     alt="<?=$country->country_name?> flag"
                      width="60px" height="40px"/>
                </div>
            <?php
            endforeach;
            ?>
        </div>

        <?php
        if(isset($_SESSION['user'])):
        ?>
            <button type="button" id="poll-btn"
             class="btn btn-primary d-block mx-auto px-5">
             Glasajte</button>
        <?php
        else:
        ?>
            <a href="index.php?page=login">
                <button type="button" class="btn btn-outline-primary
                 d-block mx-auto px-5">Ulogujte se da bi glasali</button>
            </a>
        <?php
        endif;
        ?>
    </form>

    <div class="col-12 col-md-5 d-block mx-auto mt-4">
        <div class="alert alert-secondary user-alert text-center"
         id="poll-alert" role="alert">

        </div>
    </div>
</div>
<script src="assets/js/index.js"></script>
