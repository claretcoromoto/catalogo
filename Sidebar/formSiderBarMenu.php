<?php

class formSiderBarMenu{
    function _construct(){}
    
    
function formSider(){
    
    echo '        <div class="sidebar">

                <!-- Logo -->
                <div class="logo">
                    
                </div>
                <div class="sidebar-dropdown"><a href="#">Navegación</a></div>

                <!--- Sidebar navigation -->
                <!-- If the main navigation has sub navigation, then add the class "has_sub" to "li" of main navigation. -->

                <!-- Colors: Add the class "br-red" or "br-blue" or "br-green" or "br-orange" or "br-purple" or "br-yellow" to anchor tags to create colorful left border -->
                <div class="s-content">

                    <ul id="nav">
                        <!-- Main menu with font awesome icon -->
                      <li class="has_sub"><a href="#" class="br-purple"><i class="icon-user"></i>Administración de usuarios <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
                            <ul>
                                <li><a href="AdminBuscarRifCliente.php">Registro de usuarios</a></li>
                                <li><a href="AdminBuscarRifBdActual.php">Actualización de usuarios</a></li>
                                <li><a href="AdminRolUsuario.php">Rol de usuarios</a></li>
                                <li><a href="AdminBuscarRifResetearContrasena.php">Resetear contraseña de usuarios</a></li>
                            </ul>
                        </li>  

                      
                        <li class="has_sub"><a href="#" class="br-green"><i class="icon-user-md"></i>Administración de clientes<span class="pull-right"><i class="icon-chevron-right"></i></span></a>
                            <ul>
                         <li><a href="view_admin_buscar_rif_reactivarcliente.php">Reactivación de clientes</a></li>
                                <li><a href="AdminBuscarRifReasignarUnCliente.php">Reasignar un cliente</a></li>
                                   <li><a href="AdminReasignarTodosClientes.php">Reasignar varios clientes a vendedores</a></li>
                                    <li><a href="view_admin_buscar_rif_anularcliente.php">Anulación de clientes</a></li>
                                               <li><a href="view_admin_buscar_rif_sancionarcliente.php">Sanción de clientes</a></li>
                        </ul>
                        </li>              
                          <li class="has_sub"><a href="#" class="br-blue"><i class="icon-th-list"></i>Administración de pedidos <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
                            <ul>  
                                <li><a href="AdminReactivarPedidos.php">Reactivación de pedidos</a></li>
                                <li><a href="AdminCondicionesVta.php">Condiciones de ventas </a></li>
                                <li><a href="AdminRegistrarCondVta.php">Establecer condiciones de venta</a></li>
                               <!--  <li><a href="AdminActualizarCondicionesVta.php">Modificar condiciones de venta</a></li>
                                -->
                            </ul>
                        </li>  
                         <li class="has_sub"><a href="#" class="br-red"><i class="icon-wrench"></i>Admón de repuestos <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
                            <ul>
                           <li><a href="AdminRegistrarRepuesto.php">Registro de repuestos</a></li>
                                <li><a href="AdminBuscarRepuesto.php">Actualizar  repuesto</a></li>
                                <li><a href="AdminCategoriaRepuesto.php">Categorías  de repuestos</a></li>
                           <li><a href="AdminRegistrarCategoriaRepuesto.php">Registrar categorías  de repuestos</a></li>
                         </ul>
                        </li>  
                        <li class="has_sub"><a href="#" class="br-yellow"><i class="icon-truck"></i>Localizaciones <span class="pull-right"><i class="icon-chevron-right"></i></span></a>
                            <ul>
                                <li><a href="AdminEstado.php">Estado</a></li>
                       
                                <li><a href="AdminEditarMunicipio.php">Editar municipio</a></li>
                                <li><a href="AdminRegistrarMunicipio.php">Registrar municipio</a></li>
                                 <li><a href="AdminCiudadEditar.php">Editar ciudad</a></li>
                                   <li><a href="AdminRegistrarCiudad.php">Registrar ciudad</a></li>
                            </ul>
                        </li>  
          
               
                     <li class="has_sub"><a href="#" class="br-yellow"><i class="icon-wrench"></i>Cambio de valores<span class="pull-right"><i class="icon-chevron-right"></i></span></a>
                             <ul>      
                                <li><a href="AdminConfigMotivoAnulacion.php">Configurar motivo de anulación</a></li>
                                <li><a href="AdminRegistrarMotivoAnul.php">Registrar motivo</a></li>
                                <li><a href="AdminEditarMotivoA.php">Modificar motivos</a></li>
                                <li><a href="AdminEstatusP.php">Configurar estatus</a></li>
                              </ul>
                        </li>  
                    </ul>
                 </div>
            </div> ';
    
    
}
    
    
}
?>
