<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>
        
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-header">
                                <h5 class="title">Informations du client:</h5>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                    <div class="col-md-5 px-md-1">
                                            <div class="form-group">
                                                    <label>Numero CIN</label>
                                                    <input type="text" class="form-control text-white" disabled="" value="<?=$row->client->cin?>" name="cin">
                                            </div>
                                    </div>
                                    <div class="col-md-3 px-md-1">
                                            <div class="form-group">
                                                    <label>Nom de client</label>
                                                    <input type="text" class="form-control text-white" disabled="" value="<?=$row->client->nom?>" name="nom">
                                            </div>
                                    </div>
                                    <div class="col-md-4 pl-md-1">
                                            <div class="form-group">
                                                    <label >Prenom de client</label>
                                                    <input type="text" class="form-control text-white" disabled="" value="<?=$row->client->prenom?>" name="prenom">
                                            </div>
                                    </div>
                            </div>
                            <div class="row">
                                        <div class="col-md-6 pr-md-1">
                                                <div data-toggle="collapse" data-target="#CinCollapse" aria-expanded="false" aria-controls="CinCollapse">
                                                        <button class="btn btn-link text-light" type="button">
                                                                CIN image:
                                                        </button>
                                                        <span class="float-right mx-auto p-3">
                                                                <i class="fa-solid fa-chevron-down"></i>  
                                                        </span>
                                                        <hr>
                                                </div>

                                                <div class="row">
                                                        <div class="col">
                                                                <div class="collapse multi-collapse" id="CinCollapse">
                                                                        <?php if($row->client->cin_img): ?>

                                                                                <img src="<?=ROOT?>/<?=$row->client->cin_img?>">

                                                                        <?php else: ?>
                                                                                
                                                                                <h4 class="text-center">CIN image n'existe pas!</h4>

                                                                        <?php endif; ?>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                                        <div class="col-md-6 pl-md-1">
                                                <div data-toggle="collapse" data-target="#PermisCollapse" aria-expanded="false" aria-controls="PermisCollapse">
                                                        <button class="btn btn-link text-light" type="button">
                                                                Permis image:
                                                        </button>
                                                        <span class="float-right mx-auto p-3">
                                                                <i class="fa-solid fa-chevron-down"></i>  
                                                        </span>
                                                        <hr>
                                                </div>

                                                <div class="row">
                                                        <div class="col">
                                                                <div class="collapse multi-collapse" id="PermisCollapse">
                                                                        <?php if($row->client->permis_img): ?>

                                                                                <img src="<?=ROOT?>/<?=$row->client->permis_img?>">

                                                                        <?php else: ?>
                                                                                
                                                                                <h4 class="text-center">Permis image n'existe pas!</h4>

                                                                        <?php endif; ?>
                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6 pr-md-1">
                                            <label>Numero de telephone</label>
                                            <input type="text" class="form-control text-white" disabled="" value="<?=$row->client->client_phone?>" name="client_phone">
                                    </div>
                            </div>

                            <hr>
                            <h5 class="title">Informations du location:</h5>
                            
                            <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>Date de debut:</label>
                                                    <input type="date" class="form-control text-white" disabled=""  value="<?=$row->date_depart?>" name="date_depart" >
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                            <div class="form-group">
                                                    <label>Date de retour:</label>
                                                    <input type="date" class="form-control text-white" disabled="" value="<?=$row->date_retour?>" name="date_retour" >
                                            </div>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4 pr-md-1">
                                            <div class="form-group">
                                                    <label>Prix/jour: (En DHs)</label>
                                                    <div class="input-group">
                                                            <input type="text" class="form-control text-white" disabled="" value="<?=$row->prix?>" id="price" name="prix">
                                                    </div> 
                                            </div>
                                    </div>
                            </div>
                        </div>
                        <div class="card-footer">
                                <a href="<?=ROOT?>/locations/">
                                        <button type="button" class="btn btn-fill btn-danger">Retour</button>
                                </a>
                                <?php if($row->state == 1): ?>
                                        <a href="<?=ROOT?>/locations/finLocation/<?=$row->id_location?>">
                                                <button type="button" class="btn btn-fill btn-primary float-right">Fin de location</button>
                                        </a>
                                <?php endif; ?>
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
                                        <a href="#">
                                                <img class="avatar" src="" >
                                                <h5 class="title"><?=$row->voiture->marque?> <?=$row->voiture->model?></h5>
                                        </a>
                                        <p class="description">Matricule: <?=$row->voiture->matricule?></p>
                                </div>
                                </p>
                                <div class="card-description">
                                        <p>Date Assurance: <?=get_date($row->voiture->assurances->date_debut)?> - <?=get_date($row->voiture->assurances->date_debut)?></p>
                                        <p>Date Viniete: <?=get_date($row->voiture->viniete)?></p>
                                        <p>Dernirer kilometrage: <?=$row->voiture->kilometers->dernier_km?> Km</p>
                                </div>
                        </div>
                        <div class="card-footer">
                                <div class="button-container">
                                        <a href="<?=ROOT?>/voitures/details/<?=$row->voiture->matricule?>">
                                                <button href="" class="btn btn-primary justify-content-center">Voir detailles..</button>  
                                        </a>
                                        
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

<?php $this->view('includes/footer'); ?>