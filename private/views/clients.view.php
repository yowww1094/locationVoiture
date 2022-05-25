<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>
        
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header">
                        <h2 class="text-center mt-3">Tout les clients!</h2>
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
                                <a href="<?=ROOT?>/clients/">
                                    <button class="btn btn-primary">Afficher tous</button>
                                </a>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body float-right border">
                                        <form method="POST">
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
                                                <div class="col-5">
                                                    <label>Numero telephone client</label>
                                                    <input type="text" class="form-control" value="<?=get_var('client_phone')?>" name="client_phone">
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
                                        <th>CIN</th>
                                        <th>Numero de telephone</th>
                                        <th>Date d'inscription</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($rows) && $rows): ?>
                                        <?php $num = 1 ?>
                                        <?php foreach($rows as $row): ?>
                                            
                                            <tr>
                                                <td><?=$num?></td>
                                                <td><?=$row->prenom?></td>
                                                <td><?=$row->nom?></td>
                                                <td><?=$row->cin?></td>
                                                <td><?=$row->client_phone?></td>
                                                <td><?=get_date($row->date_added)?></td>
                                                <td>
                                                    <a href="<?=ROOT?>/clients/edit/<?=$row->id_client?>/">
                                                        <button class="btn btn-sm btn-primary">Modifier</button>
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
                                                <td><?=$row->prenom?></td>
                                                <td><?=$row->nom?></td>
                                                <td><?=$row->cin?></td>
                                                <td><?=$row->client_phone?></td>
                                                <td><?=get_date($row->date_added)?></td>
                                                <td>
                                                    <a href="<?=ROOT?>/clients/edit/<?=$row->id_client?>/">
                                                        <button class="btn btn-sm btn-primary">Modifier</button>
                                                    </a>
                                                </td>
                                            </tr>

                                            <?php $num += 1 ?>
                                        <?php endforeach; ?>

                                    <?php else: ?>

                                        <?php if(empty($rows)): ?>

                                            <tr>
                                                <td colspan="6"><h2 class="text-center">Pas de clients a ce moment!</h2></td>
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
