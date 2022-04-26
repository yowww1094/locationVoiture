<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>
        
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    
                    <div class="card-header">
                        <h2 class="text-center mt-3">Tout les clients!</h2>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table tablesorter " id="">
                                <thead class=" text-primary">
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
                                    <?php else: ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                        <h2 class="text-center">Pas de clients a ce moment!</h2>
                                        
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
