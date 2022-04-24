<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>

        <div class="content">

        <div class="row">
                <div class="col-md-12">
                        <div class="card">
                                <h3 class="p-4 card-title text-center">Ajouter une voiture!</h3>
                                <div class="card-body">
                                        <form method="post">

                                        <div class="mx-auto" style="width:100%; max-width:600px">
                                                
                                                <?php if(count($errors) > 0): ?>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Error!</strong>
                                                        <?php foreach($errors as $error): ?>
                                                        <br><?=$error?>
                                                        <?php endforeach; ?>
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true" class="text-dark">&times;</span>
                                                </div>
                                                <?php endif;?>
                                                
                                                <div class="mb-3">
                                                        <label class="text-white font-weight-bold" for="matricule">Matricule de voiture</label>
                                                        <input value="<?=get_var('matricule')?>" type="text" class="form-control text-dark bg-white" name="matricule" autofocus>
                                                </div>

                                                <div class="mb-3">
                                                        <label class="text-white font-weight-bold" for="marque">Marque de voiture</label>
                                                        <input list="marques" value="<?=get_var('marque')?>" type="text" class="form-control text-dark bg-white" name="marque">
                                                        <datalist id="marques">
                                                                <option value="Audi">
                                                        </datalist>
                                                </div>

                                                <div class="mb-3">
                                                        <label class="text-white font-weight-bold" for="model">Model de voiture</label>
                                                        <input value="<?=get_var('model')?>" type="text" class="form-control text-dark bg-white" name="model" >
                                                </div>

                                                <div class="mb-3">
                                                        <label class="text-white font-weight-bold" for="date_assurance">Date Assurance de voiture</label>
                                                        <input type="date" class="form-control text-dark bg-white" name="date_assurance">
                                                </div>

                                                <div class="mb-3">
                                                        <label class="text-white font-weight-bold" for="date_viniete">Date Viniete de voiture</label>
                                                        <input type="date" class="form-control text-dark bg-white" name="date_viniete">
                                                </div>

                                                <div class="mb-3">
                                                        <label class="text-white font-weight-bold" for="dernier_km">Derniere kilometrage de voiture</label>
                                                        <input <?=get_var('dernier_km')?> type="number" class="form-control text-dark bg-white" name="dernier_km">
                                                </div>

                                                <div class="mb-3">
                                                        <label class="text-white font-weight-bold" for="image_voiture">Selectionner image de voiture</label>
                                                        <input  type="file" class="form-control text-dark bg-white" name="image_voiture">
                                                </div>

                                                <br>
                                                <a href="<?=ROOT?>/voitures/">
                                                        <button type="button" class="btn btn-danger">Cancel</button>
                                                </a>
                                                <button type="reset" class="btn btn-danger">Vider</button>
                                                <button type="submit" class="btn btn-primary float-end">Ajouter</button>
                                        </div>        
                                        </form>
                                </div>
                        </div>   
                </div>
        </div>
        
            
        </div>

<?php $this->view('includes/footer'); ?>