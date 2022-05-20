<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>

        <div class="content">
            <div class="card justrify-content-center">
                <div class="card-header">
                    <h3 class="text-center pt-2">Êtes-vous sûr de vouloir supprimer cette location?</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <input type="text" class="form-control" value="<?=get_var('location', $row->id_location)?>" disabled='' name="location">
                        <input type="hidden" name="location">
                        <input type="submit" value="Confirmer" class="btn btn-fill btn-danger float-right">
                    </form>
                </div>
            </div>

            <?php show($row)?>
        </div>

<?php $this->view('includes/footer'); ?>
