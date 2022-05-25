<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>

        <div class="content">
            <div class="row">
                <div class="col">
                    <?php if(count($errors) > 0): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Error!</strong>

                                    <?php foreach($errors as $error): ?>

                                        <br><?=$error?>

                                    <?php endforeach; ?>

                                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php endif;?>

                    <form method="post">
                        <div class="card justrify-content-center">
                            <div class="card-header">
                                <h3 class="text-center pt-2">Fin de location!</h3>
                            </div>
                            <div class="card-body">
                                <hr>
                                <h5 class="title">Informations du client:</h5>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>Numero CIN</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$row->client->cin?>" name="cin">
                                    </div>
                                    <div class="col-md-3 ">
                                        <label>Nom de client</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$row->client->nom?>" name="nom">
                                    </div>
                                    <div class="col-md-4">
                                        <label >Prenom de client</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$row->client->prenom?>" name="prenom">
                                    </div>
                                </div>
                                <hr>
                                <h5 class="title">Informations du location:</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Date de debut:</label>
                                        <input type="date" class="form-control text-white" disabled=""  value="<?=$row->date_depart?>" name="date_depart" >
                                    </div>
                                    <div class="col-md-6">
                                        <label>Date de retour:</label>
                                        <input type="date" class="form-control text-white" disabled="" value="<?=$row->date_retour?>" name="date_retour" >
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-4 pr-md-1">
                                        <label>Prix/jour: (En DHs)</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$row->prix?>" id="price" name="prix">
                                    </div>
                                </div>
                                <hr>
                                <h5 class="title">Informations du location:</h5>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>Marque</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$row->voiture->marque?>" name="cin">
                                    </div>
                                    <div class="col-md-3 ">
                                        <label>Model</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$row->voiture->model?>" name="nom">
                                    </div>
                                    <div class="col-md-4">
                                        <label >matricule</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$row->voiture->matricule?>" name="prenom">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label >Veuillez remplir le derniere kilometre du voiture</label>
                                        <input type="text" class="form-control text-white" name="last_kilometer">
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="<?=ROOT?>/locations/details/<?=$row->id_location?>">
                                    <button type="button" class="btn btn-fill btn-primary">Annuler</button>
                                </a>
                                <button type="submit" class="btn btn-fill btn-danger float-right">Finir location</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


<?php $this->view('includes/footer'); ?>
