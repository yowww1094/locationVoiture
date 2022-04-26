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
                            <h5 class="title">Informations du voiture:</h5>
                        </div>

                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-5 pl-md-1">
                                    <div class="form-group">
                                        <label >Matricule</label>
                                        <input type="text" class="form-control text-white" value="<?=$rows->matricule?>" name="matricule" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-3 px-md-1">
                                    <div class="form-group">
                                        <label>Marque</label>
                                        <input type="text" class="form-control text-white" value="<?=$rows->marque?>" name="marque">
                                    </div>
                                </div>
                                <div class="col-md-4 px-md-1">
                                    <div class="form-group">
                                        <label>Model</label>
                                        <input type="text" class="form-control text-white" value="<?=$rows->model?>" name="model">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 px-md-1">
                                    <label>Date d'assurance</label>
                                    <input type="date" class="form-control text-white" value="<?=get_date($rows->date_assurance)?>" name="date_assurance">
                                </div>
                                <div class="col-md-6  px-md-1">
                                    <label>Date de viniete</label>
                                    <input  type="date" class="form-control text-white" value="<?=get_date($rows->date_viniete)?>" name="date_viniete">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                    <div class="col-md-6 px-md-1">
                                            <label>Derniere kilometrage</label>
                                            <input type="text" class="form-control text-white" value="<?=$rows->dernier_km?>" name="dernier_km">
                                    </div>
                            </div>

                            <div class="card-footer">
                                
                                <button type="submit" class="btn btn-fill btn-primary float-right">Enregistrer</button>
                                <a href="<?=ROOT?>/voitures/details/<?=$rows->matricule?>">
                                    <button type="button" class="btn btn-fill btn-danger">Retour</button>
                                </a>
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

                                </div>
                            </p>
                            <input type="file" class="form-control" name="image_voiture">
                            <div class="card-description">
                                <h4 class="text-center">Voiture ajoutee le: <?=$rows->date_added?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        
    </div>


<?php $this->view('includes/footer'); ?>
