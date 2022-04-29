<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>
        
    <div class="content">

        <div class="row">
            <div class="col-md-12">
                
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <div data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <button class="btn btn-link text-light" type="button">Notification des voitures:</button>
                                    <span class="float-right mx-auto p-3">
                                        <i class="fa-solid fa-chevron-down"></i>  
                                    </span>
                                    <hr>
                                </div>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">

                                <?php if(isset($rows) && $rows): ?>

                                    <?php if($rows['notificationsVoiture']): ?>
                                        <?php foreach($rows['notificationsVoiture'] as $row): ?>
                                            <?php if($row->type_notification == 'vedenge' || $row->type_notification == 'mechanic'): ?>

                                                <div class="alert alert-warning alert-with-icon" data-notify="container">
                                                    <div class="float-right">
                                                        <a href="<?=ROOT?>/voitures/details/<?=$row->matricule?>/">
                                                            <button type="button"  class="btn btn-sm btn-primary" >Confirmer</button>
                                                        </a>
                                                    </div>

                                                    <span data-notify="icon" class="fa fa-bell"></span>
                                                    <span data-notify="message">
                                                        <b><?=strtoupper($row->type_notification)?> VOITURE</b>
                                                        <p>Date de <?=$row->type_notification?> de voiture: <?=$row->matricule?> serait le: <?=$row->next_date?></p>
                                                    </span>
                                                </div>

                                            <?php elseif($row->type_notification == 'assurance' || $row->type_notification == 'viniete'): ?>

                                                <div class="alert alert-danger alert-with-icon" data-notify="container">
                                                    <div class="float-right" >
                                                        <a href="<?=ROOT?>/voitures/details/<?=$row->matricule?>/">
                                                            <button type="button"  class="btn btn-sm btn-primary" >Confirmer</button>
                                                        </a>
                                                    </div>

                                                    <span data-notify="icon" class="fa fa-bell"></span>
                                                    <span data-notify="message">
                                                        <b><?=strtoupper($row->type_notification)?> VOITURE</b>
                                                        <p>Date de paiment de <?=$row->type_notification?> de voiture: <?=$row->matricule?> serait le: <?=$row->next_date?></p>
                                                    </span>
                                                </div>

                                            <?php endif; ?> 
                                        <?php endforeach; ?>    
                                    <?php else: ?>

                                        <h4 class="text-center">Pas de notifications a ce moment</h4>    

                                    <?php endif; ?>
                                        
                                              
                                <?php endif; ?>                     

                            </div>
                        </div>
                    </div>



                    <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <div class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                    <button class="btn btn-link text-light" type="button">Notifications des locations:</button>
                                    <span class="float-right mx-auto p-3">
                                        <i class="fa-solid fa-chevron-down"></i>  
                                    </span>
                                    <hr>
                                </div>
                            </h5>
                        </div>

                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                
                                <?php if(isset($rows) && $rows): ?>

                                    <?php if($rows['notificationsLocation']): ?>
                                        <?php foreach($rows['notificationsLocation'] as $row): ?>

                                            <div class="alert alert-info alert-with-icon" data-notify="container">
                                                <div class="float-right">
                                                    <a href="<?=ROOT?>/locations/details/<?=$row->id_location?>/">
                                                        <button type="button"  class="btn btn-sm btn-primary" >Confirmer</button>
                                                    </a>
                                                </div>

                                                <span data-notify="icon" class="fa fa-bell"></span>
                                                <span data-notify="message">
                                                    <b><?=strtoupper($row->type_notification)?> LOCATION -</b>

                                                    <?php if($row->type_notification == 'reservation'): ?>
                                                        <p>
                                                            Date de <?=$row->type_notification?> de location du client <?=strtoupper($row->location->client->prenom)?> 
                                                            <?=strtoupper($row->location->client->nom)?> serait le <?=$row->location->date_depart?>
                                                        </p>
                                                    <?php elseif($row->type_notification == 'retour'): ?>
                                                        <p>
                                                            Date de <?=$row->type_notification?> de location du client <?=strtoupper($row->location->client->prenom)?> 
                                                            <?=strtoupper($row->location->client->nom)?> serait le <?=$row->location->date_retour?>
                                                        </p>
                                                    <?php endif; ?>    

                                                </span>
                                            </div>

                                        <?php endforeach; ?>
                                    <?php else: ?>

                                        <h4 class="text-center">Pas de notifications a ce moment</h4>

                                    <?php endif; ?>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<?php $this->view('includes/footer'); ?>
