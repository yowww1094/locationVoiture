<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>
        
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    
                    <div class="card-header">
                        <h2 class="text-center mt-3">Tout les assurances!</h2>
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
                                <a href="<?=ROOT?>/assurances/">
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
                                                    <label>Numero</label>
                                                    <input type="text" class="form-control" value="<?=get_var('agence')?>" name="agence">
                                                </div>
                                                <div class="col">
                                                    <label>Agence</label>
                                                    <input type="text" class="form-control" value="<?=get_var('agence')?>" name="agence">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Date d'assurance depuis</label>
                                                    <input type="date" class="form-control" value="<?=get_var('date_depart')?>" name="date_depart">
                                                </div>
                                                <div class="col">
                                                    <label>Date d'assurance justqu'a</label>
                                                    <input type="date" class="form-control" value="<?=get_var('date_retour')?>" name="date_retour">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <label>Prix</label>
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
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter">
                                <thead class="text-primary">
                                    <tr>
                                        <th>№</th>
                                        <th>Voiture</th>
                                        <th>Numero</th>
                                        <th>Agence</th>
                                        <th>Date debut</th>
                                        <th>Date fin</th>
                                        <th>Prix</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($rows) && $rows): ?>
                                        <?php $num = 1 ?>
                                        <?php foreach($rows as $row): ?>
                                            
                                            <tr>
                                                <td><?=$num?></td>
                                                <td><?=$row->marque?> <?=$row->model?>: <?=$row->matricule?></td>
                                                <td><?=$row->numero?></td>
                                                <td><?=$row->agence?></td>
                                                <td><?=get_date($row->date_debut)?></td>
                                                <td><?=get_date($row->date_fin)?></td>
                                                <td><?=$row->prix?> DHs</td>
                                                <td>
                                                    <a href="<?=ROOT?>/voitures/details/<?=$row->matricule?>/">
                                                        <button class="btn btn-sm btn-primary"><i class="fa-solid fa-car"></i></button>
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php $num += 1 ?>
                                        <?php endforeach; ?>
                                    <?php elseif(isset($searchResults) && $searchResults): ?>
                                        <?php $num = 1 ?>
                                        <?php foreach($searchResults as $row): ?>
                                            
                                            <tr>
                                                <td><?=$num?></td>
                                                <td><?=$row->marque?> <?=$row->model?>: <?=$row->matricule?></td>
                                                <td><?=$row->numero?></td>
                                                <td><?=$row->agence?></td>
                                                <td><?=get_date($row->date_debut)?></td>
                                                <td><?=get_date($row->date_fin)?></td>
                                                <td><?=$row->prix?> DHs</td>
                                                <td>
                                                    <a href="<?=ROOT?>/voitures/details/<?=$row->matricule?>/">
                                                        <button class="btn btn-sm btn-primary"><i class="fa-solid fa-car"></i></button>
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php $num += 1 ?>
                                        <?php endforeach; ?>

                                    <?php else: ?>

                                        <?php if(empty($rows)): ?>

                                            <tr>
                                                <td colspan="7"><h2 class="text-center">Pas de d'assurance!</h2></td>
                                            </tr>

                                        <?php elseif(empty($searchResults)): ?>

                                            <tr>
                                                <td colspan="7"><h2 class="text-center">Aucun resultat a votre rechrche!</h2></td>
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
