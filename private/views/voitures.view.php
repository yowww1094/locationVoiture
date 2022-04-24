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

                <?php if(isset($rows) && $rows): ?>
                    <?php foreach($rows as $row): ?>
                        <div class="col-4">
                            <div class="card" style="width: 18rem;">

                                <?php if($row->image_voiture): ?>
                                    <img src="<?=$row->image_voiture?>" class="card-img-top">
                                <?php else: ?>
                                    <img src="<?=ASSETS?>/images/car-alt.png" class="card-img-top">
                                <?php endif; ?>
                                
                                <div class="card-body">
                                    <h3 class="card-title text-center font-weight-bold"><?=ucfirst($row->marque)?></h3>
                                    <p class="card-text text-center"><?=$row->model?></p>
                                    <br>
                                    <p class="card-text">Date d'ajoute: <?=$row->date_added?></p>
                                    <a href="#" class="btn btn-primary">Voir detailles...</a>
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
            

            <?php if(isset($rows) && $rows): ?>
                <?php foreach($rows as $row): ?>

                    <div class="card" style="width: 18rem;">

                        <?php if($row->image_voiture): ?>
                            <img src="<?=$row->image_voiture?>" class="card-img-top">
                        <?php else: ?>
                            <img src="<?=ASSETS?>/images/car-alt.png" class="card-img-top">
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <h3 class="card-title text-center font-weight-bold"><?=ucfirst($row->marque)?></h3>
                            <p class="card-text text-center"><?=$row->model?></p>
                            <br>
                            <p class="card-text">Date d'ajoute: <?=$row->date_added?></p>
                            <a href="#" class="btn btn-primary">Voir detailles...</a>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>
                <h2 class="text-center">Pas de voiture en location!</h2>
            <?php endif; ?>
            

        </div>

<?php $this->view('includes/footer'); ?>

