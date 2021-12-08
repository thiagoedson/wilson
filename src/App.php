<?php

namespace App;

use Exception;
use Modulo\Modulo;
use Usuario\Usuario;

class App
{
    public $versao = '1.0.0';
    public $app_name = 'adisul.net';
    public $app_theme_color = '';
    public $app_logo = '../assets/svg/logo_adisul.svg';

    /**
     * @return string
     */
    public function getVersao()
    {
        return $this->versao;
    }

    /**
     * @param string $versao
     */
    public function setVersao($versao)
    {
        $this->versao = $versao;

    }

    /**
     * @return string
     */
    public function getAppThemeColor()
    {
        return $this->app_theme_color;
    }

    /**
     * @param string $app_theme_color
     */
    public function setAppThemeColor($app_theme_color)
    {
        $this->app_theme_color = $app_theme_color;
    }

    /**
     * @return string
     */
    public function getAppLogo()
    {
        return $this->app_logo;
    }

    /**
     * @param string $app_logo
     */
    public function setAppLogo($app_logo)
    {
        $this->app_logo = $app_logo;
    }

    /**
     * @return string
     */
    public function getAppName(): string
    {
        return $this->app_name;
    }

    /**
     * @param string $app_name
     */
    public function setAppName(string $app_name): void
    {
        $this->app_name = $app_name;
    }

    public function GerarFooter()
    {
        try {

            #region Content Header (Page header)
            $html = null;
            ob_start();
            ?>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; <?php echo date('Y'); ?></span>
                    </div>
                </div>
            </footer>


            <?php


            $html = trim(ob_get_contents());
            ob_end_clean();
            #endregion

            return $html;

        } catch (Exception $e) {
            return $e;
        }
    }

    public function GerarHeaderTopMenu()
    {
        try {

            $usuario = new Usuario(getUsuarioSessao());

            #region Content Header (Page header)

            ob_start();
            ?>
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                 <div class="input-group">
                     <input type="text" class="form-control bg-light border-0 small" placeholder="Procurar por..."
                            aria-label="Search" aria-describedby="basic-addon2">
                     <div class="input-group-append">
                         <button class="btn btn-primary" type="button">
                             <i class="fas fa-search fa-sm"></i>
                         </button>
                     </div>
                 </div>
             </form>-->

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                            <?php echo $usuario->getNome(); ?>
                        </span>
                        <img class="img-profile rounded-circle"
                             src="<?php echo $usuario->getFoto(); ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                         aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="../minhaconta/">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Minha conta
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../app/sair.php" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Sair
                        </a>
                    </div>
                </li>

            </ul>

            <?php


            $html = trim(ob_get_contents());
            ob_end_clean();
            #endregion
            return $html;

        } catch (Exception $e) {
            return $e;
        }
    }

    public function GerarMenuLeft()
    {
        try {

            $usuario = new Usuario(getUsuarioSessao());

            #region Content Header (Page header)

            ob_start();
            ?>

            <!-- Topbar Navbar -->

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../home/index.php">
                <div class="sidebar-brand-icon ">
                    <i class="fas fa-arrow-right"></i>
                </div>
                <div class="sidebar-brand-text mx-3">
                    <?php echo $this->getAppName(); ?>
                </div>
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <br>

            <?php
            if ($usuario->getAdmin()) {
                ?>

                <!-- Heading -->
                <div class="sidebar-heading">
                    Admin
                </div>

                <!-- Nav Item - Admin -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                       aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-cart-arrow-down"></i>
                        <span>Pedidos</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="buttons.html">Pré-venda</a>
                            <a class="collapse-item" href="cards.html">Pronta-entrega</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Admin -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                       aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Gestão</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Utilities:</h6>
                            <a class="collapse-item" href="utilities-color.html">Clientes</a>

                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger" href="../adm/">
                        <i class="fas fa-upload"></i>
                        <span>Importador</span></a>
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <?php
            }
            ?>


            <!-- Heading -->
            <div class="sidebar-heading">
                Minha rede
            </div>


            <li class="nav-item">
                <a class="nav-link" href="../minhaconta/">
                    <i class="fas fa-user-tag"></i>
                    <span>Minha conta</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../minhaconta/pedidos.php">
                    <i class="fas fa-scroll"></i>
                    <span>Meus pedidos</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="../loja/?q=pronta_entrega">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Pronta-entrega</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../loja/?q=pronta_entrega">
                    <i class="fab fa-shopify"></i>
                    <span>Pré-venda FW22</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../app/sair.php" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sair</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


            <?php


            $html = trim(ob_get_contents());
            ob_end_clean();
            #endregion
            return $html;

        } catch (Exception $e) {
            return $e;
        }
    }

    public function Modulo()
    {

        return new Modulo();

    }


}