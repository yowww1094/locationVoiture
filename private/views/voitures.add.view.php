<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>

        <div class="content">
                
                
        <h3>voitures add</h3>

        <?php if(count($errors) > 0): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Error!</strong>
                        <?php foreach($errors as $error): ?>
                        <br><?=$error?>
                        <?php endforeach; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        <?php endif;?>

        <form method="POST">
                mat: <input type="text" name="matricule">
                marque: <input type="text" name="marque">
                model: <input type="text" name="model">
                assurance: <input type="date" name="date_assurance">
                vienet: <input type="date" name="date_viniete">
                km: <input type="text" name="dernire_km">
                <button type="submit">submit</button>
        </form>
            
        </div>

<?php $this->view('includes/footer'); ?>