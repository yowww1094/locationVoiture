<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>
 
<div class="content"> 
        <div class="row">
                <div class="col-md-8">

                <?php if(count($errors) > 0): ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Error!</strong>

                                <?php foreach($errors as $key=>$value): ?>
                                        <?php foreach($value as $error): ?>

                                                <br><?=$error?>

                                        <?php endforeach; ?>
                                <?php endforeach; ?>

                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                <?php endif;?>

                <form method="post">
                        <div class="card">
                                <div class="card-header">
                                        <h5 class="title">Informations du client:</h5>
                                </div>

                                <div class="card-body">
                                        <form>
                                                <div class="row">
                                                        <div class="col-md-5 px-md-1">
                                                                <div class="form-group">
                                                                        <label>Numero CIN</label>
                                                                        <input type="text" class="form-control" placeholder="CIN" value="<?=get_var('cin')?>" name="cin">
                                                                </div>
                                                        </div>
                                                        <div class="col-md-3 px-md-1">
                                                                <div class="form-group">
                                                                        <label>Nom de client</label>
                                                                        <input type="text" class="form-control" placeholder="Nom" value="<?=get_var('nom')?>" name="nom">
                                                                </div>
                                                        </div>
                                                        <div class="col-md-4 pl-md-1">
                                                                <div class="form-group">
                                                                        <label >Prenom de client</label>
                                                                        <input type="text" class="form-control" placeholder="Prenom" value="<?=get_var('prenom')?>" name="prenom">
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6 pr-md-1">
                                                                <label>CIN</label>
                                                                <input type="file" class="form-control" value="<?=get_var('cin_image')?>" name="cin_image">
                                                        </div>
                                                        <div class="col-md-6 pl-md-1">
                                                                <label>Permis de conduit</label>
                                                                <input  type="file" class="form-control" value="<?=get_var('permis_image')?>" name="permis_image">

                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-6 pr-md-1">
                                                                <label>Numero de telephone</label>
                                                                <input type="text" class="form-control" value="<?=get_var('client_phone')?>" name="client_phone">
                                                        </div>
                                                </div>

                                                <hr>
                                                <h5 class="title">Informations du location:</h5>

                                                <?php if(isset($info) && $info): ?>

                                                        <div class="alert alert-danger" role="alert">
                                                                <i class="fa-solid fa-triangle-exclamation"></i>
                                                                Voiture: <?=strtoupper($voiture->marque)?> <?=$voiture->model?>: <?=$voiture->matricule?>. 
                                                                <br>
                                                                <?php foreach($info as $row): ?>
                                                                        
                                                                        En location: Depuis <?=$row->date_depart?> - Jusqu'a <?=$row->date_retour?>.<br>

                                                                <?php endforeach;?>
                                                        </div>

                                                <?php endif;?>
                                                
                                                <div class="row">
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                        <label>Date de debut:</label>
                                                                        <input type="date" class="form-control" value="<?=get_var('date_depart')?>" name="date_depart" >
                                                                </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                        <label>Date de retour:</label>
                                                                        <input type="date" class="form-control" value="<?=get_var('date_retour')?>" name="date_retour" >
                                                                </div>
                                                        </div>
                                                </div>
                                                <div class="row">
                                                        <div class="col-md-4 pr-md-1">
                                                                <div class="form-group">
                                                                        <label>Prix/jour: (En DHs)</label>
                                                                        <div class="input-group">
                                                                                <input type="text" class="form-control" id="price" value="<?=get_var('prix')?>" name="prix">
                                                                        </div> 
                                                                </div>
                                                        </div>
                                                </div>
                                        </form>
                                </div>
                                <div class="card-footer">
                                        <button type="submit" class="btn btn-fill btn-primary float-right">Enregistrer</button>
                                        <a href="<?=ROOT?>/locations/">
                                                <button type="button" class="btn btn-fill btn-danger">Cancel</button>
                                        </a>
                                        <button type="reset" class="btn btn-fill btn-danger">Vider</button>
                                </div>
                        </div>
                </div>
                </form>
                <div class="col-md-4">
                        <div class="card card-user">
                                <div class="card-body">
                                        <p class="card-text">
                                        <div class="author">
                                                <div class="block block-one"></div>
                                                <div class="block block-two"></div>
                                                <div class="block block-three"></div>
                                                <div class="block block-four"></div>
                                                <a href="#">
                                                        <img class="avatar" src="" >
                                                        <h5 class="title"><?=$voiture->marque?> <?=$voiture->model?></h5>
                                                </a>
                                                <p class="description">Matricule: <?=$voiture->matricule?></p>
                                        </div>
                                        </p>
                                        <div class="card-description">
                                                <p>Date Assurance: <?=get_date($voiture->date_assurance)?></p>
                                                <p>Date Viniete: <?=get_date($voiture->date_viniete)?></p>
                                                <p>Dernirer kilometrage: <?=$voiture->dernier_km?> Km</p>
                                        </div>
                                </div>
                                <div class="card-footer">
                                        <div class="button-container">
                                                <a href="#">
                                                        <button href="" class="btn btn-primary justify-content-center">Voir detailles..</button>  
                                                </a>
                                                
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>


<?php $this->view('includes/footer'); ?>

