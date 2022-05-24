<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>

        
    <div class="content">

        <div class="row">
            <div class="col-md-8">

                <div class="card">

                    <div class="card-body p-4">
                        <h5 class="title">Informations du voiture:</h5>
                        <div class="row">
                            <div class="col-md-5 pl-md-1">
                                <div class="form-group">
                                    <label >Matricule</label>
                                    <input type="text" class="form-control text-white" disabled="" value="<?=$rows->matricule?>">
                                </div>
                            </div>
                            <div class="col-md-3 px-md-1">
                                <div class="form-group">
                                    <label>Marque</label>
                                    <input type="text" class="form-control text-white" disabled="" value="<?=strtoupper($rows->marque)?>">
                                </div>
                            </div>
                            <div class="col-md-4 px-md-1">
                                <div class="form-group">
                                    <label>Model</label>
                                    <input type="text" class="form-control text-white" disabled="" value="<?=strtoupper($rows->model)?>">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5 class="title">Informations d'assurance:</h5>
                        <div class="row">
                            <div class="col-md-6 px-md-1">
                                <label>Numero d'assurance</label>
                                <input type="text" class="form-control text-white" disabled="" value="<?=$rows->assurances->numero?>">
                            </div>
                            <div class="col-md-6  px-md-1">
                                <label>Agence</label>
                                <input  type="text" class="form-control text-white" disabled="" value="<?=strtoupper($rows->assurances->agence)?>" >
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-6 px-md-1">
                                        <label>Date debut</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$rows->assurances->date_debut?>" >
                                </div>
                                <div class="col-md-6 px-md-1">
                                        <label>Date fin</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$rows->assurances->date_fin?> KM" >
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-md-4 px-md-1">
                                        <label>Prix</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$rows->assurances->prix?> DHs" >
                                </div>
                        </div>
                        <hr>
                        <div class="row">
                                <div class="col-md-6 px-md-1">
                                        <label>Derniere kilometrage</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$rows->kilometers->last_kilometer?>" >
                                </div>
                                <div class="col-md-6 px-md-1">
                                        <label>Date</label>
                                        <input type="text" class="form-control text-white" disabled="" value="<?=$rows->kilometers->date_added?>" >
                                </div>
                        </div>

                        <div class="card-footer">
                            <a href="<?=ROOT?>/voitures/edit/<?=$rows->matricule?>/">
                                <button type="button" class="btn btn-fill btn-primary float-right">Modifier</button>
                            </a>
                            <a href="<?=ROOT?>/voitures/">
                                <button type="reset" class="btn btn-fill btn-danger">Retour</button>
                            </a>
                            <a href="<?=ROOT?>/locations/add/<?=$rows->matricule?>/">
                                    <button type="button" class="btn btn-fill btn-danger">Faire location</button>
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
                                    <img src="<?=ROOT?>/<?=$rows->image_voiture?>" class="card-img-top">
                                <?php else: ?>
                                    <img src="<?=ASSETS?>/images/car-alt.png" class="card-img-top">
                                <?php endif; ?>

                            </div>
                        </p>
                        <div class="card-description">
                            <h4 class="text-center">Voiture ajoutee le: <?=$rows->date_added?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h3 class="text-center mt-3">Entretiens de voiture!</h3>
                        <a href="<?=ROOT?>/entretiens/add/<?=$rows->matricule?>">
                            <button class="btn btn-primary float-right">Ajouter entretien</button>
                        </a>
                        <br>
                        <br>
                        <hr>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter ">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>№</th>
                                        <th>Date d'entretien</th>
                                        <th>Garage</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Prix</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($rows->entretien) && $rows->entretien): ?>
                                        <?php $num = 1 ?>
                                        <?php foreach($rows->entretien as $row): ?>
                                            
                                            <tr>
                                                <td><?=$num?></td>
                                                <td><?=get_date($row->date_entretien)?></td>
                                                <td><?=$row->garage?></td>
                                                <td><?=$row->type_entretien?></td>
                                                <td><?=$row->description?></td>
                                                <td><?=$row->prix_entretien?> DHs</td>
                                                
                                            </tr>

                                            <?php $num += 1 ?>

                                        <?php endforeach; ?>
                                    <?php else: ?>

                                        <tr>
                                            <td colspan="7"><h2 class="text-center">Pas de entretiens a ce moment!</h2></td>
                                        </tr>
                                        
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
                <?php show($rows)?>
        </div>

        
    </div>


<?php $this->view('includes/footer'); ?>
