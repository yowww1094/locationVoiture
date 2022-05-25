<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>
        
    <div class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        
                        <h1 class="text-center font-weight-bold text-decoration-underline">Tous les voitures!</h1>
                        <div class="d-flex justify-content-between">

                            <div class="div">

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
                                <a href="<?=ROOT?>/voitures/">
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
                                                <div class="col-5">
                                                    <label>Etat de voiture</label>
                                                    <select name="state" class="form-control">
                                                        <option <?=get_select('state', '')?> value="" class="text-dark">--Sélectionnez l'etat de voiture--</option>
                                                        <option <?=get_select('state', 'disponible')?> value="disponible" class="text-dark">Disponible</option>
                                                        <option <?=get_select('state', 'location')?> value="location" class="text-dark">En location</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label>Date assurance depuis</label>
                                                    <input type="date" class="form-control" value="<?=get_var('date_assurance_depuis')?>" name="date_assurance_depuis">
                                                </div>
                                                <div class="col">
                                                    <label>Date assurance justqu'a</label>
                                                    <input type="date" class="form-control" value="<?=get_var('date_assurance_jusqua')?>" name="date_assurance_jusqua">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-primary float-right"><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div>

                                <?php if($_SESSION['USER']->rank == 'admin'): ?>

                                    <a href="<?=ROOT?>/voitures/add/">
                                        <button class="btn btn-primary">Ajouter voiture</button>
                                    </a>

                                <?php endif; ?>

                            </div>
                        </div>                                                       
                    </div>
                    <hr>

                    <div class="card-body">

                        <div class="row">

                            <?php if(isset($rows) && $rows): ?>
                                <?php foreach($rows as $row): ?>
                                    
                                    <div class="col-sm-3">
                                        <div class="card card-user">
                                            <div class="bg-dark pt-2">
                                                
                                                <?php if($row->state == '1'): ?>

                                                    <h4 class="text-center">Status: <b class="text-success">Disponible</b></h4>

                                                <?php elseif($row->state == '0'): ?>

                                                    <h4 class="text-center">Status: <b class="text-danger">En location</b></h4>

                                                <?php endif; ?>  

                                            </div>

                                            <div class="card-body">
                                                <div class="author  mt-0">
                                                    <a href="<?=ROOT?>/voitures/details/<?=$row->matricule?>">

                                                        <?php if($row->image_voiture): ?>

                                                            <img src="<?=ROOT?>/<?=$row->image_voiture?>" class="card-img-top">
                                                        <?php else: ?>
                                                            <img src="<?=ASSETS?>/images/car-alt.png" class="card-img-top">
                                                        <?php endif; ?>
                                                        <br>

                                                        <h4 class="title"><?=$row->matricule?></h4>
                                                        <h5 class="title"><?=ucfirst($row->marque)?> <?=$row->model?></h5>                                  
                                                    </a>
                                                </div> 
                                            </div>
                                            <div class="card-footer justify-content-center">
                                                <div class="button-container">
                                                    <a href="<?=ROOT?>/voitures/details/<?=$row->matricule?>/">
                                                        <button class="btn btn-sm btn-primary">Details</button>
                                                    </a>
                                                    <a href="<?=ROOT?>/locations/add/<?=$row->matricule?>/">
                                                        <button class="btn btn-sm btn-primary">Faire location</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            <?php elseif(isset($searchResults) && $searchResults): ?>
                                <?php foreach($searchResults as $row): ?>
                                    
                                    <div class="col-sm-3">
                                        <div class="card card-user">
                                            <div class="bg-dark pt-2">
                                                
                                                <?php if($row->state == '1'): ?>

                                                    <h4 class="text-center">Status: <b class="text-success">Disponible</b></h4>

                                                <?php elseif($row->state == '0'): ?>

                                                    <h4 class="text-center">Status: <b class="text-danger">En location</b></h4>

                                                <?php endif; ?>  

                                            </div>

                                            <div class="card-body">
                                                <div class="author  mt-0">
                                                    <a href="<?=ROOT?>/voitures/details/<?=$row->matricule?>">

                                                        <?php if($row->image_voiture): ?>
                                                            <img src="<?=$row->image_voiture?>" class="card-img-top">
                                                        <?php else: ?>
                                                            <img src="<?=ASSETS?>/images/car-alt.png" class="card-img-top">
                                                        <?php endif; ?>

                                                        <h4 class="title"><?=$row->matricule?></h4>
                                                        <h5 class="title"><?=ucfirst($row->marque)?> <?=$row->model?></h5>                                  
                                                    </a>
                                                </div> 
                                            </div>
                                            <div class="card-footer justify-content-center">
                                                <div class="button-container">
                                                    <a href="<?=ROOT?>/voitures/details/<?=$row->matricule?>/">
                                                        <button class="btn btn-sm btn-primary">Details</button>
                                                    </a>
                                                    <a href="<?=ROOT?>/locations/add/<?=$row->matricule?>/">
                                                        <button class="btn btn-sm btn-primary">Faire location</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>

                            <?php else: ?>
                                <h2 class="text-center">Pas de voitures!</h2>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php $pager->display() ?>
                </div>
            </div>
        </div>
        
    </div>

<?php $this->view('includes/footer'); ?>

