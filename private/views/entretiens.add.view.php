<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>

        
    <div class="content">

        <form method="POST">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        
                        <?php if(count($errors) > 0): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Error!</strong>
                                <?php foreach($errors as $error): ?>
                                    <br><?=$error?>
                                <?php endforeach; ?>
                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif;?>

                        <div class="card-header">
                            <h5 class="title">Ajouter entretien:</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 pl-md-1">
                                    <div class="form-group">
                                        <label >Type d'entretien</label>
                                        <select class="form-control" name="type_entretien">
                                            <option <?=get_select('type_entretien', '')?> value="">--Sélectionnez un type--</option>
                                            <option <?=get_select('type_entretien', 'videnge')?> class="text-dark" value="videnge">Videnge</option>
                                            <option <?=get_select('type_entretien', 'mechanic')?> class="text-dark" value="mechanic">Mechanique</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 px-md-1">
                                    <div class="form-group">
                                        <label>Date d'entretien</label>
                                        <input type="date" value="<?=get_var('date_entretien')?>" class="form-control" name="date_entretien">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12  px-md-1">
                                    <label>Description d'entretien</label>
                                    <textarea name="description" value="<?=get_var('description')?>" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 px-md-1">
                                    <label>Prix d'entretien</label>
                                    <input type="text" value="<?=get_var('prix_entretien')?>" class="form-control" name="prix_entretien">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary float-right">Enregistrer</button>
                                <a href="<?=ROOT?>/voitures/details/<?=$rows->matricule?>">
                                    <button type="button" class="btn btn-fill btn-danger">Retour</button>
                                </a>
                                <button type="reset" class="btn btn-danger">Vider</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="card-body">
                            <p class="card-text">
                                <div class="author">
                                    <div class="block block-one"></div>
                                    <div class="block block-two"></div>
                                    <div class="block block-three"></div>
                                    <div class="block block-four"></div>

                                    <?php if($rows->image_voiture): ?>
                                        <img src="<?=$rows->image_voiture?>" class="card-img-top">
                                    <?php else: ?>
                                        <img src="<?=ASSETS?>/images/car-alt.png" class="card-img-top">
                                    <?php endif; ?>
                                    <h4 class="title"><?=$rows->matricule?></h4>
                                    <h5 class="title"><?=ucfirst($rows->marque)?> <?=$rows->model?></h5>
                                    <h5 class="text-center">Voiture ajoutee le: <?=$rows->date_added?></h5>
                                </div>
                            </p>
                            <div class="card-description">
                                <h5>Date d'assurance: <?=$rows->date_assurance?></h5>
                                <h5>Date de viniete: <?=$rows->date_viniete?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        
    </div>


<?php $this->view('includes/footer'); ?>
