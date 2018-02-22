<div class="snap-drawers">
        <!-- Left Sidebar -->
        <div class="snap-drawer snap-drawer-left">
            
            <div class="sidebar-header" style="overflow:hidden;">
                <a href="#"><i class="fa fa-times"></i></a>                
            </div>
                    
            <div class="sidebar-divider">
                Menu
            </div>
            
            <ul class="sidebar-navigation">
                <li class="has-submenu">
                    <a class="deploy-submenu" href="#"><i class="fa fa-user"></i>Personer<i class="fa fa-plus"></i></a>
                    <ul class="submenu">
						<li><a href="timeline-kopi.php"><i class="fa fa-angle-right"></i>Alle<i class="fa fa-circle"></i></a></li>
						<?php
							//get events from database
							$query = mysql_query("SELECT * FROM `users` WHERE `family id` = 1", $connection);

							//error checking
							if($query === FALSE) { 
								die(mysql_error()); 
							}	
							
							//Display users in list
							while($rowtwo = mysql_fetch_array($query)) {
								if($rowtwo['home']){
									echo '<li><a href="timeline-kopi.php?user='.$rowtwo["id"].'">
									<i class="fa fa-angle-right"></i>'.$rowtwo["name"].'
									<i class="fa fa-circle" id="home"></i></a></li>';
								} else {
									echo '<li><a href="timeline-kopi.php?user='.$rowtwo["id"].'">
									<i class="fa fa-angle-right"></i>'.$rowtwo["name"].'
									<i class="fa fa-circle" id="not-home"></i></a></li>';
								}
							}
						?>
                    </ul>
                </li>
                <li><a href="page-error.php"><i class="fa fa-cog"></i>Indstillinger<i class="fa fa-circle"></i></a></li>
                <li><a href="logout.php"><i class="fa fa-cog"></i>Logud<i class="fa fa-circle"></i></a></li>
            </ul>                        
            <div class="sidebar-divider">
                Copyright 2016. All rights reserved.
            </div>
        </div>
    </div>