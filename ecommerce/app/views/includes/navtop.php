


<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top " role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo Url::path() ?>/main/index">Gypsy Technologies</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle"  data-toggle="dropdown">Shields <span class="glyphicon glyphicon-triangle-bottom small"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <li><a tabindex="-1" href="<?php echo Url::path() ?>/categories/western-shields">West</a></li>
                            <li><a tabindex="-1" href="<?php echo Url::path() ?>/categories/easter-shields">East</a></li>
                        </li>
                    </ul>
                </li>


                    <li class="dropdown">
                        <a class="dropdown-toggle"  data-toggle="dropdown">Armour <span class="glyphicon glyphicon-triangle-bottom small"></span></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a class="test" tabindex="-1" href="#">1v1 <span class="glyphicon glyphicon-triangle-right small"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo Url::path() ?>/categories/1v1-head">Head</a></li>
                                        <li><a href="<?php echo Url::path() ?>/categories/1v1-upperbody">Upper Body</a></li>
                                        <li><a href="<?php echo Url::path() ?>/categories/1v1-lowerbody">Lower Body</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a class="test" tabindex="-1" href="#">Bohurt <span class="glyphicon glyphicon-triangle-right small"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo Url::path() ?>/categories/bohurt-lowerbody">Head</a></li>
                                        <li><a href="<?php echo Url::path() ?>/categories/bohurt-upperbody">Upper Body</a></li>
                                        <li><a href="<?php echo Url::path() ?>/categories/bohurt-lowerbody">Lower Body</a></li>
                                    </ul>
                                </li>
                            </ul>
                    </li>

                <li class="dropdown">
                    <a class="dropdown-toggle"  data-toggle="dropdown">Paddings <span class="glyphicon glyphicon-triangle-bottom small"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                                <li><a tabindex="-1" href="<?php echo Url::path() ?>/categories/paddings-head">Head</a></li>
                                <li><a tabindex="-1" href="<?php echo Url::path() ?>/categories/paddings-upperbody">Upper</a></li>
                                <li><a tabindex="-1" href="<?php echo Url::path() ?>/categories/paddings-lowerbody">Lower</a></li>
                        </li>
                    </ul>
                </li>

                <li>
                    <a tabindex="-1" href="<?php echo Url::path() ?>/categories/others">Other</a>
                </li>

                <li>
                    <a href="<?php echo Url::path() ?>/main/about">About</a>
                </li>
                <li>
                    <a href="<?php echo Url::path() ?>/main/contact">Contact</a>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
               <?php if(!Session::exists('user')) : ?>
                <li>
                    <a href="<?php echo Url::path() ?>/main/login">Login</a>
                </li>

                <li>
                    <a href="<?php echo Url::path() ?>/main/register">Register</a>
                </li>
                <?php else :?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo Session::get('username');?> <b class="glyphicon glyphicon-triangle-bottom small"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo Url::path() ?>/main/profile"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo Url::path() ?>/main/settings"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <?php if(Session::exists('admin')) : ?>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo Url::path() ?>/main/admin"><i class="fa fa-fw fa-power-off"></i> Admin</a>
                        </li>
                        <?php endif ;?>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo Url::path() ?>/main/logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                <?php endif ;?>
                        <li>
                            <a href="<?php echo Url::path() ?>/cart/index"><i class="fa fa-fw fa-cart"></i> Cart (<?php echo $basket->itemCount();?>)</a>
                        </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

