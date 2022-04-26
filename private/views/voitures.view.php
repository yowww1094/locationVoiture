<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>
        
        <div class="content">

            <h1 class="text-center font-weight-bold text-decoration-underline">Tous les voitures!</h1>
            <a href="<?=ROOT?>/voitures/add/">
                <button class="btn btn-primary float-right">Ajouter voiture</button>
            </a>
            <br>
            <br>
            <hr>
            <h3>Voitures disponible:</h3>

            <div class="row">

                <?php if(isset($rows['available']) && $rows['available']): ?>
                    <?php foreach($rows['available'] as $row['available']): ?>
                        
                        <div class="col-md-4">
                            <div class="card card-user">
                                <div class="card-body">
                                    <p class="card-text">
                                        <div class="author">
                                            <a href="<?=ROOT?>/voitures/details/<?=$row['available']->matricule?>">

                                                <?php if($row['available']->image_voiture): ?>
                                                    <img src="<?=$row['available']->image_voiture?>" class="card-img-top">
                                                <?php else: ?>
                                                    <img src="<?=ASSETS?>/images/car-alt.png" class="card-img-top">
                                                <?php endif; ?>

                                                <h4 class="title"><?=$row['available']->matricule?></h4>
                                                <h5 class="title"><?=ucfirst($row['available']->marque)?> <?=$row['available']->model?></h5>
                                                <h5 class="text-center">Voiture ajoutee le: <?=$row['available']->date_added?></h5>                                            </a>
                                        </div>
                                    </p>
                                    <div class="card-description">
                                        <h5>Date d'assurance: <?=get_date($row['available']->date_assurance)?></h5>
                                        <h5>Date de viniete: <?=get_date($row['available']->date_viniete)?></h5>
                                    </div>
                                </div>
                                <div class="card-footer justify-content-center">
                                    <div class="button-container">
                                        <a href="<?=ROOT?>/voitures/details/<?=$row['available']->matricule?>/">
                                            <button class="btn btn-sm btn-primary">Detailles..</button>
                                        </a>
                                        <a href="<?=ROOT?>/locations/add/<?=$row['available']->matricule?>/">
                                            <button class="btn btn-sm btn-primary">Faire location</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <h2 class="text-center">Pas de voiture disponible!</h2>
                <?php endif; ?>
            </div>
            <br>
            <hr>
            <h3>Voitures en location:</h3>

            <div class="row">

                <?php if(isset($rows['unavailable']) && $rows['unavailable']): ?>
                    <?php foreach($rows['unavailable'] as $row['unavailable']): ?>
                        

                        <div class="col-md-4">
                            <div class="card card-user">
                                <div class="card-body">
                                    <p class="card-text">
                                        <div class="author">
                                            <a href="<?=ROOT?>/voitures/details/<?=$row['unavailable']->matricule?>">

                                                <?php if($row['unavailable']->image_voiture): ?>
                                                    <img src="<?=$row['unavailable']->image_voiture?>" class="card-img-top">
                                                <?php else: ?>
                                                    <img src="<?=ASSETS?>/images/car-alt.png" class="card-img-top">
                                                <?php endif; ?>

                                                <h4 class="title"><?=$row['unavailable']->matricule?></h4>
                                                <h5 class="title"><?=ucfirst($row['unavailable']->marque)?> <?=$row['unavailable']->model?></h5>
                                                <h5 class="text-center">Voiture ajoutee le: <?=$row['unavailable']->date_added?></h5>
                                            </a>
                                        </div>
                                    </p>
                                    <div class="card-description">
                                        <h5>Date d'assurance: <?=get_date($row['unavailable']->date_assurance)?></h5>
                                        <h5>Date de viniete: <?=get_date($row['unavailable']->date_viniete)?></h5>
                                    </div>
                                </div>
                                <div class="card-footer justify-content-center">
                                    <div class="button-container">
                                        <a href="<?=ROOT?>/voitures/details/<?=$row['unavailable']->matricule?>">
                                            <button class="btn btn-sm btn-primary">Detailles..</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <h2 class="text-center">Pas de voiture disponible!</h2>
                <?php endif; ?>
            </div>
            

        </div>

<?php $this->view('includes/footer'); ?>

