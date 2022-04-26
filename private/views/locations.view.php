<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        
                        <div class="card-header">
                            <h1 class="text-center mt-3">Tout les locations!</h1>
                            <hr>
                            <a href="<?=ROOT?>/voitures/">
                                <button class="btn btn-sm btn-primary float-right"> Ajouter une location</button>
                            </a>
                            
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table tablesorter " id="">
                                    <thead class=" text-primary">
                                        <tr>
                                            <th></th>
                                            <th>Voiture</th>
                                            <th>Client</th>
                                            <th>CIN</th>
                                            <th>Date de location</th>
                                            <th>Date depart</th>
                                            <th>Duree</th>
                                            <th>Prix/jour</th>
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
                                                    <td><?=$row->voiture->marque?> <?=$row->voiture->model?></td>
                                                    <td><?=$row->client->nom?> <?=$row->client->prenom?></td>
                                                    <td><?=$row->client->cin?></td>
                                                    <td><?=$row->date_location?></td>
                                                    <td><?=$row->date_depart?></td>
                                                    <td><?=$row->duree_location?> Jour</td>
                                                    <td><?=$row->prix?> DHs</td>
                                                </tr>

                                            <?php endforeach; ?>
                                        <?php else: ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                            <h2 class="text-center">Pas de location a ce moment!</h2>
                                            
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
