<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>
        
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h2 class="text-center mt-3">Archives</h2>
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
                                <a href="<?=ROOT?>/logs/">
                                    <button class="btn btn-primary">Afficher tous</button>
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body float-right border">
                                        <form method="POST">
                                            <div class="row">
                                                <div class="col">
                                                    <label>Prenom</label>
                                                    <input type="text" class="form-control" value="<?=get_var('marque')?>" name="firstname">
                                                </div>
                                                <div class="col">
                                                    <label>Nom</label>
                                                    <input type="text" class="form-control" value="<?=get_var('model')?>" name="lastname">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-5">
                                                    <label>Grade</label>
                                                    <select name="rank" class="form-control text-dark">
                                                        <option <?=get_select('rank', '')?> value="">--Sélectionnez type d'entretien--</option>
                                                        <option <?=get_select('rank', 'agent')?> value="agent">Agent</option>
                                                        <option <?=get_select('rank', 'admin')?> value="admin">Responsable</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Date depuis</label>
                                                    <input type="date" class="form-control" value="<?=get_var('date_location_depuis')?>" name="date_location_depuis">
                                                </div>
                                                <div class="col">
                                                    <label>Date justqu'a</label>
                                                    <input type="date" class="form-control" value="<?=get_var('date_location_jusqua')?>" name="date_location_jusqua">
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
                                        <th>Prenom</th>
                                        <th>Nom</th>
                                        <th>Grade</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($rows) && $rows): ?>
                                        <?php $num = 1 ?>
                                        <?php foreach($rows as $row): ?>
                                            
                                            <tr>
                                                <td><?=$num?></td>
                                                <td><?=ucfirst($row->firstname)?></td>
                                                <td><?=ucfirst($row->lastname)?></td>
                                                <td><?=strtoupper($row->rank)?></td>
                                                <td>Cree <a href="<?=ROOT?>/locations/details/<?=$row->id_location?>">location</a> pour voiture <?=$row->matricule?></td>
                                                <td><?=get_date($row->date_location)?></td>
                                            </tr>

                                            <?php $num += 1 ?>
                                        <?php endforeach; ?>
                                    <?php elseif(isset($searchResults) && $searchResults): ?>
                                        <?php $num = 1 ?>
                                        <?php foreach($searchResults as $row): ?>
                                            
                                            <tr>
                                                <td><?=$num?></td>
                                                <td><?=ucfirst($row->firstname)?></td>
                                                <td><?=ucfirst($row->lastname)?></td>
                                                <td><?=strtoupper($row->rank)?></td>
                                                <td>Cree <a href="<?=ROOT?>/locations/details/<?=$row->id_location?>">location</a> pour voiture <?=$row->matricule?></td>
                                                <td><?=get_date($row->date_location)?></td>
                                            </tr>

                                            <?php $num += 1 ?>
                                        <?php endforeach; ?>

                                    <?php else: ?>

                                        <?php if(empty($rows)): ?>

                                            <tr>
                                                <td colspan="6"><h2 class="text-center">Pas de d'archives!</h2></td>
                                            </tr>

                                        <?php elseif(empty($searchResults)): ?>

                                            <tr>
                                                <td colspan="6"><h2 class="text-center">Aucun resultat a votre rechrche!</h2></td>
                                            </tr>
                                        <?php endif; ?>
 
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php $pager->display() ?>
                </div>
            </div>
        </div>
    </div>

<?php $this->view('includes/footer'); ?>
