<aside class="left-sidebar">
    <div class="scroll-sidebar">
        <div class="user-profile">
            <div class="profile-img">
                <!-- <img src="<?php echo Url::getBase() ?>assets/images/<?php echo $gApp->getFotoPerfil() ?>" alt="user" /> -->
                <img src="<?php echo Url::getBase() . 'modulo/usuario/img/' . $gApp->getFotoPerfil() ?>" alt="user" />
            </div>
            <div class="profile-text">
                <h5><?php echo $gApp->getNameUser() ?></h5>
                <h6><?php echo $gApp->set_mascara($gApp->getCpfUser(), '###.###.###-##') ?></h6>
                <a href="<?php echo Url::getBase() ?>" class="" data-toggle="tooltip" title="Página inicial"><i class="mdi mdi-home text-primary"></i></a>
                <a href="<?php echo Url::getBase() ?>logof" class="" data-toggle="tooltip" title="Sair do Sistema"><i class="mdi mdi-power text-danger"></i></a>
            </div>
        </div>
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <?php
                $menu = $gApp->getMenu();
                $mods = '';
                foreach ($menu as $rstMenu) {
                    if ($rstMenu->flg_submodulo == 1) {
                        $tmpMods = '<li>';
                        $tmpMods .= '<a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="' . $rstMenu->icone . '"></i><span class="hide-menu">' . $rstMenu->modulo . '</span></a>';
                        $tmpMods .= '<ul aria-expanded="false" class="collapse">';

                        foreach ($rstMenu->sub as $rstSub) {
                            $tmpMods .= '<li><a href="' . Url::getBase() . $rstMenu->link . '/' . $rstSub->link_submodulo . '"><i class="' . $rstSub->icone_submodulo . '"></i> ' . $rstSub->submodulo . '</a></li>';
                        }

                        $tmpMods .= '</ul>';
                        $tmpMods .= '</li>';
                        $mods .= $tmpMods;
                    } else {
                        $tmpMods = '<li>';
                        $tmpMods .= '<a class="waves-effect waves-dark" href="' . Url::getBase() . $rstMenu->link . '"><i class="' . $rstMenu->icone . '"></i><span class="hide-menu">' . $rstMenu->modulo . '</span></a>';
                        $tmpMods .= '</li>';
                        $mods .= $tmpMods;
                    }
                }
                echo $mods;
                ?>
            </ul>
        </nav>
    </div>
</aside>