<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>

<div class="content">
        <form method="post" enctype="multipart/form-data">
                <div class="row">
                        <div class="col-md-8">

                                <?php if(count($errors) > 0): ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>Error!</strong>

                                                <?php foreach($errors as $key => $value): ?>
                                                        <?php foreach($value as $error): ?>

                                                                <br><?=$error?>

                                                        <?php endforeach; ?>
                                                <?php endforeach; ?>

                                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                <?php endif;?>

                                
                                <div class="card">

                                        <div class="card-header">
                                                <h3 class="pt-3 card-title text-center">Ajouter une voiture</h3>
                                        </div>
                                        <hr>
                                        <div class="card-body">
                                                <h5 class="title">Informations du voiture:</h5>
                                                <div class="row">
                                                        <div class="col-md-4 pr-md-1">
                                                                <label>Marque</label>
                                                                <input list="marques" type="text" class="form-control" value="<?=get_var('marque')?>" name="marque">
                                                                <datalist id="marques">
                                                                        <option value="Audi">
                                                                        <option value="Mercedes">
                                                                        <option value="Dacia">
                                                                        <option value="Volgswagen">
                                                                </datalist>
                                                        </div>
                                                        <div class="col-md-4 pl-md-1">
                                                                <label>Model</label>
                                                                <input  type="text" class="form-control" value="<?=get_var('model')?>" name="model">

                                                        </div>
                                                        <div class="col-md-4 pl-md-1">
                                                                <label>Matricule</label>
                                                                <input  type="text" class="form-control" value="<?=get_var('matricule')?>" name="matricule">
                                                        </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                        <div class="col-md-4 pr-md-1">
                                                                <label>Date viniete</label>
                                                                <input  type="date" class="form-control" value="<?=get_var('viniete')?>" name="viniete">

                                                        </div>
                                                </div>

                                                <hr>
                                                <h5 class="title">Informations d'assurance:</h5>

                                                <div class="row">
                                                        <div class="col-md-8">
                                                                <div class="form-group">
                                                                        <label>Numero d'assurance:</label>
                                                                        <input type="text" class="form-control" value="<?=get_var('numero')?>" name="numero" >
                                                                </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                                <div class="form-group">
                                                                        <label>Agence:</label>
                                                                        <input type="text" class="form-control" value="<?=get_var('agence')?>" name="agence" >
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                        <label>Date debut d'assurance:</label>
                                                                        <input type="date" class="form-control" value="<?=get_var('date_debut')?>" name="date_debut" >
                                                                </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                        <label>Date fin d'assurance:</label>
                                                                        <input type="date" class="form-control" value="<?=get_var('date_fin')?>" name="date_fin" >
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-4 pr-md-1">
                                                                <div class="form-group">
                                                                        <label>Prix d'assurance: (En DHs)</label>
                                                                        <input type="text" class="form-control" id="price" value="<?=get_var('prix')?>" name="prix">
                                                                </div>
                                                        </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                        <div class="col-md-4 pr-md-1">
                                                                <div class="form-group">
                                                                        <label>Derniere Kilometrage: (En Km)</label>
                                                                        <input type="text" class="form-control" id="price" value="<?=get_var('last_kilometer')?>" name="last_kilometer">
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="card-footer">
                                                
                                                <a href="<?=ROOT?>/voitures/">
                                                        <button type="button" class="btn btn-fill btn-danger">Cancel</button>
                                                </a>
                                                <button type="reset" class="btn btn-fill btn-danger">Vider</button>
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
                                                                <img class="card-img-top" src="<?=ASSETS?>/images/car-alt.png">
                                                        </div>
                                                </p>
                                                <div class="card-description">
                                                        <label class="text-white text-center font-weight-bold" for="image_voiture">Selectionner image de voiture</label>
                                                        <input  type="file" class="form-control text-dark bg-white" name="image_voiture">
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div><button type="submit" class="btn btn-fill btn-primary float-right">Ajouter</button>
        </form>
</div>

<?php $this->view('includes/footer'); ?>