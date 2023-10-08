
<body>
<?php
if(isset($_GET['id']) && isset($_SESSION['user']) && $_SESSION['user']->role_name == "Admin"
 &&  $user = getUserInfo($_GET['id'])):
    ?>
    <div class="container-fluid bg-dark text-light" id="admin-wrapper">
        <div class="row py-3">
            <div class="col-2">
                <?php
                include('views/fixed/navAdmin.php');
                $roles = getAllRoles();
                ?>
            </div>

            <div class="col-10 px-5 border-start ">
                <h2 class="fw-bold fs-1 mb-4">Izmeni korisnika</h2>
                <div class="row">
                    <div class="col-6">
                        <form>
<!--                            USERNAME-->
                            <div class="mb-3">
                                <label for="username" class="form-label">Korisničko ime</label>
                                <input type="text" value="<?=$user->username?>"
                                 class="form-control" id="username" name="username">
                                <small class="text-danger"></small>
                            </div>

<!--                            EMAIL ADRESA-->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email adresa</label>
                                <input type="email" value="<?=$user->email?>"
                                 class="form-control" id="email" name="email">
                                <small class="text-danger"></small>
                            </div>

<!--                            TELEFON-->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefon</label>
                                <input type="text" value="<?=$user->phone?>"
                                 class="form-control" id="phone" name="phone">
                                <small class="text-danger"></small>
                            </div>

<!--                            ULOGA-->
                            <div class="mb-3">
                                <label for="roleID" class="form-label">Uloga</label>
                                <select class="form-select" id="roleID"
                                 name="roleID">
                                    <?php
                                    foreach ($roles as $r):
                                    ?>
                                    <option
                                            <?php
                                            if($user->roleID == $r->id){
                                                echo 'selected';
                                            }
                                            ?>
                                            value="<?=$r->id?>"><?=$r->role_name?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <small class="text-danger"></small>
                            </div>

<!--                            LOZINKA-->
                            <div class="mb-3">
                                <p class="test-light">* Zabranjeno je menjati lozinku.</p>
                            </div>

<!--                            ID KORISNIKA-->
                            <input name="id" id="id" type="hidden" value="<?=$user  ->id?>"/>


                            <button type="button" id="edit-user-btn"
                             class="btn btn-primary px-5 mx-auto d-block">Izmeni</button>
                        </form>

                        <div class="alert alert-secondary user-alert mt-4"
                         role="alert" id="user-alert">
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