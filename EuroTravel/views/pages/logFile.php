<body>
<?php
if(isset($_SESSION['user']) && $_SESSION['user']->role_name == "Admin"):
    $stranice = getAllLinks();
?>
    <div class="container-fluid bg-dark text-light" id="admin-wrapper">
        <div class="row py-3">
            <div class="col-2">
                <?php
                include('views/fixed/navAdmin.php');
                ?>
            </div>
            <div class="col-10 px-5 border-start ">
            <div class="container">
    <div class="row">
        <div class="col-6 mx-auto">
        <table class="table">
            <thead class="text-light">
                <tr>
                    <th>Stranica</th>
                    <th>BrojPristupa</th>
                </tr>
            </thead>
            <tbody class="text-light">
                <?php 
                    foreach($stranice as $stranica):
                ?>
                <tr>
                    <td><?=$stranica->route?></td>
                    <td><?=getAccess($stranica->name)?></td>
                </tr>

                <?php
                    endforeach;
                ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
</body>
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
<script src="assets/js/edit.js"></script>