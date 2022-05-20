<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                
                <div class="card-header">
                    <h2 class="text-center mt-3">Tout les locations!</h2>
                    <hr>

                    <div class="row">
                        <div class="col-8">

                            <?php if(count($errors) > 0): ?>
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong>Error!</strong>
                                        <?php foreach($errors as $error): ?>
                                                <br><?=$error?>
                                        <?php endforeach; ?>
                                        <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif;?>

                            <button class="ml-1 btn  btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Recherche Avancee
                            </button>
                            <a href="<?=ROOT?>/locations/">
                                    <button class="btn btn-primary">Afficher tous</button>
                                </a>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body float-right border">
                                    <form method="POST">
                                        <div class="row">
                                        <div class="col">
                                                <label>Marque</label>
                                                <input type="text" class="form-control" value="<?=get_var('marque')?>" name="marque">
                                            </div>
                                            <div class="col">
                                                <label>Model</label>
                                                <input type="text" class="form-control" value="<?=get_var('model')?>" name="model">
                                            </div>
                                            <div class="col">
                                                <label>Matricule</label>
                                                <input type="text" class="form-control" value="<?=get_var('matricule')?>" name="matricule">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label>Prenom Client</label>
                                                <input type="text" class="form-control" value="<?=get_var('prenom')?>" name="prenom">
                                            </div>
                                            <div class="col">
                                                <label>Nom Client</label>
                                                <input type="text" class="form-control" value="<?=get_var('nom')?>" name="nom">
                                            </div>
                                            <div class="col">
                                                <label>CIN Client</label>
                                                <input type="text" class="form-control" value="<?=get_var('cin')?>" name="cin">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label>Date depart</label>
                                                <input type="date" class="form-control" value="<?=get_var('date_depart')?>" name="date_depart">
                                            </div>
                                            <div class="col">
                                                <label>Date retour</label>
                                                <input type="date" class="form-control" value="<?=get_var('date_retour')?>" name="date_retour">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label>Prix/Jours</label>
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control" value="<?=get_var('prixMin')?>" name="prixMin" placeholder="Min">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" value="<?=get_var('prixMax')?>" name="prixMax" placeholder="Max">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <a href="<?=ROOT?>/voitures/">
                                <button class="btn btn-primary float-right"> Ajouter une location</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter ">
                            <thead class="text-primary">
                                <tr>
                                    <th></th>
                                    <th>Voiture</th>
                                    <th>Client prenom</th>
                                    <th>Client nom</th>
                                    <th>CIN</th>
                                    <th>Date de location</th>
                                    <th>Prix/jour</th>
                                    <th>Date depart</th>
                                    <th>Date retour</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($rows) && $rows): ?>
                                    <?php foreach($rows as $row): ?>
                                        
                                        <tr>
                                            <td>
                                                <a href="<?=ROOT?>/locations/details/<?=$row->id_location?>">
                                                    <button class="btn btn-sm btn-primary">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            <td><?=$row->voiture->marque?> <?=$row->voiture->model?> : <?=$row->voiture->matricule?></td>
                                            <td><?=ucfirst($row->client->prenom)?></td>
                                            <td><?=ucfirst($row->client->nom)?></td>
                                            <td><?=$row->client->cin?></td>
                                            <td><?=$row->date_location?></td>
                                            <td><?=$row->prix?> DHs</td>
                                            <td><?=$row->date_depart?></td>
                                            <td><?=$row->date_retour?></td>
                                            
                                        </tr>

                                    <?php endforeach; ?>
                                    
                                <?php elseif(isset($searchResults) && $searchResults): ?>

                                    <?php foreach($searchResults as $row): ?>
                                        
                                        <tr>
                                            <td>
                                                <a href="<?=ROOT?>/locations/details/<?=$row->id_location?>">
                                                    <button class="btn btn-sm btn-primary">
                                                        <i class="fa fa-chevron-right"></i>
                                                    </button>
                                                </a>
                                            </td>
                                            <td><?=$row->marque?> <?=$row->model?> : <?=$row->matricule?></td>
                                            <td><?=ucfirst($row->client->prenom)?></td>
                                            <td><?=ucfirst($row->client->nom)?></td>
                                            <td><?=$row->client->cin?></td>
                                            <td><?=$row->date_location?></td>
                                            <td><?=$row->prix?> DHs</td>
                                            <td><?=$row->date_depart?></td>
                                            <td><?=$row->date_retour?></td>
                                            
                                        </tr>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <?php if(empty($rows)): ?>

                                        <tr>
                                            <td colspan="8"><h2 class="text-center">Pas de locations!</h2></td>
                                        </tr>

                                    <?php elseif(empty($searchResults)): ?>

                                        <tr>
                                            <td colspan="8"><h2 class="text-center">Aucun resultat a votre rechrche!</h2></td>
                                        </tr>
                                    <?php endif; ?>
                                
                                    
                                    
                                <?php endif; ?>

                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        </div>
    </div>   
    
</div>



<?php $this->view('includes/footer'); ?>
