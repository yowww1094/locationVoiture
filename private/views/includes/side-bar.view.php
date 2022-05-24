        
        
        <div class="sidebar">
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li>
                        <a href="<?=ROOT?>">
                            <i class="fas fa-dashboard"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=ROOT?>/notifications/">
                            <i class="fas fa-exclamation-circle"></i>
                            <p>Notifications</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=ROOT?>/voitures/">
                            <i class="fas fa-car"></i>
                            <p>Voitures</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=ROOT?>/assurances/">
                            <i class="fa-solid fa-car-burst"></i>
                            <p>Assurances</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=ROOT?>/entretiens/">
                            <i class="fa-solid fa-gears"></i>
                            <p>Entretiens</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=ROOT?>/locations/">
                            <i class="fas fa-file-contract"></i>
                            <p>Locations</p>
                        </a>
                    </li>
                    <li>
                        <a href="<?=ROOT?>/clients/">
                            <i class="fas fa-user-friends"></i>
                            <p>Clients</p>
                        </a>
                    </li>
                    <?php if($_SESSION['USER']->rank == 'admin'): ?>
                        <li>
                            <a href="<?=ROOT?>/archives/">
                                <i class="fa-solid fa-briefcase"></i>
                                <p>Archive</p>
                            </a>
                        </li>
                        <li>
                            <a href="<?=ROOT?>/statistics/">
                                <i class="fa-solid fa-chart-area"></i>
                                <p>Statistiques</p>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>