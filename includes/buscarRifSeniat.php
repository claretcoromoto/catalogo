<?php

include 'sesion.class.php';
include 'ConexionPGSQL.php';

extract($_REQUEST);
try {

    $s = new sesion();
    $rol = $s->get('id_rol_usr');
    $email = $s->get('email');
    $remote_addr = $_SERVER['REMOTE_ADDR'];

    $rifup = strtoupper($rif);
     $sql = " SELECT * FROM tblsit_usr WHERE ci_rif_cliente = '" . $rifup . "'  ";
    $result = @pg_query($sql);
    if (!$file = pg_fetch_array($result)) {
        if (isset($email) && ($rol == 1)) {
            header('Location:../AdminRegistrarUsuario.php?rif=' . $rif . ' ');
        } else {
            header('Location:../Registrar_Clientes.php?rif=' . $rif . ' ');
        }
    } else {
        if ($file = pg_fetch_array($result))
            $roles = $file['id_rol_usr'];
        switch ($roles) {

            case 1:
                $s = new sesion();
                $rol = $s->get('id_rol_usr');
                $email = $s->get('email');
                $remote_addr = $_SERVER['REMOTE_ADDR'];

                if ($file['ci_rif_cliente'] == $rifup) {
                    if (isset($email) and ( $rol == 1 )) {
                        header('Location:../AdminActualizarUsuario.php?rif=' . $rifup . '');
                    } else {
                        echo "<script language='JavaScript'> alert('Puede loguearse')
                       location.href = '../login.php';
                       exit(); 
                       </script> ";
                    }
                }
                break;


            case 2:
                $s = new sesion();
                $rol = $s->get('id_rol_usr');
                $email = $s->get('email');
                $remote_addr = $_SERVER['REMOTE_ADDR'];
                if ($file['ci_rif_cliente'] == $rifup) {
                    if (isset($email) and ( $rol == 1 )) {
                        header('Location:../AdminActualizarUsuario.php?rif=' . $rifup . '');
                    } else {
                        echo "<script language='JavaScript'> alert('Puede loguearse')
                       location.href = '../login.php';
                       exit();
                       </script> ";
                    }
                }

                break;

            case 3:
                $s = new sesion();
                $rol = $s->get('id_rol_usr');
                $email = $s->get('email');
                $remote_addr = $_SERVER['REMOTE_ADDR'];
                if ($file['ci_rif_cliente'] == $rifup) {
                    if (isset($email) and ( $rol == 1 )) {
                        header('Location:../AdminActualizarUsuario.php?rif=' . $rifup . '');
                    } else {
                        echo "<script language='JavaScript'> alert('Puede loguearse')
                       location.href = '../login.php';
                       exit(); 
                       </script> ";
                    }
                }


                break;

            case 4:
                $s = new sesion();
                $rol = $s->get('id_rol_usr');
                $email = $s->get('email');
                $remote_addr = $_SERVER['REMOTE_ADDR'];

                $estatus = $file['in_status_cliente'];
                switch ($estatus) {
                    case 1:

                        if ($file['ci_rif_cliente'] == $rifup) {
                            if (isset($email) and ( $rol == 1)) {
                                header('Location:../AdminActualizarUsuario.php?rif=' . $rifup . '');
                            } else {
                                echo "<script language='JavaScript'> alert('Ud. est\u00e1 registrado, puede loguearse') 
                   location.href = '../login.php';
                   exit();
                   </script> ";
                            }
                        }
                        break;

                    case -1:
                        if ($file['ci_rif_cliente'] == $rifup) {
                            if (isset($email) and ( $rol == 1 )) {
                                header('Location:../AdminActualizarUsuario.php?rif=' . $rifup . '');
                            } else {
                                echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian') 
                    location.href = '../index.php'; 
                    exit();
                    </script> ";
                            }
                        }
                        break;
                    case 0:
                        if ($file['ci_rif_cliente'] == $rifup) {
                            if (isset($email) and ( $rol == 1)) {
                                header('Location:../AdminActualizarUsuario.php?rif=' . $rifup . '');
                            } else {
                                echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian')
                    location.href = '../index.php';  
                    exit();
                    </script> ";
                            }
                        }
                        break;

                    case 2:
                        if ($file['ci_rif_cliente'] == $rifup and $file['in_status_cliente'] == 2) {
                            if (isset($email) and ( $rol == 1 )) {
                                header('Location:../AdminActualizarUsuario.php?rif=' . $rifup . '');
                            } else {
                                echo "<script language='JavaScript'> alert('Pendiente por activar en 24 hrs') 
                     location.href = '../index.php';    
                     exit(); 
                     </script> ";
                            }
                        }

                        break;
                    case -2:
                        if ($file['ci_rif_cliente'] == $rifup) {
                            if (isset($email) and ( $rol == 1 )) {
                                header('Location:../AdminActualizarUsuario.php?rif=' . $rifup . '');
                            } else {
                                echo "<script language='JavaScript'> alert('Comun\u00edquese  con su vendedor de confianza de Xian, para su reactivaci\u00f3n')
                       location.href = '../index.php';
                       exit(); 
                       </script> ";
                            }
                        }
                        break;



                    default:
                        header('Location:../AdminBuscarRifCliente.php');
                        break;
                }
                break;
            case 5:
                $s = new sesion();
                $rol = $s->get('id_rol_usr');
                $email = $s->get('email');
                $remote_addr = $_SERVER['REMOTE_ADDR'];

                if ($file['ci_rif_cliente'] == $rifup) {
                    if (isset($email) and ( $rol == 1 )) {
                        header('Location:../AdminActualizarUsuario.php?rif=' . $rifup . '');
                    } else {
                        echo "<script language='JavaScript'> alert('Puede loguearse')
                       location.href = '../login.php';
                       exit();
                       </script> ";
                    }
                }
                break;



            default:
                $s = new sesion();
                $rol = $s->get('id_rol_usr');
                $email = $s->get('email');
                $remote_addr = $_SERVER['REMOTE_ADDR'];
                if (isset($email) and ( $rol == 1 )) {
                    header('Location:../AdminActualizarUsuario.php?rif=' . $rifup . '');
                } else {
                    echo "<script language='JavaScript'> alert('Por favor, verifique y vuelva a intentarlo') 
                    location.href = '../Buscar_Rif.php'; 
                    exit();  </script> ";
                }
                break;
        }
    }
} catch (Exception $e) {
    throw new Exception($e);
    $lo->Traza($email, 'Buscar RIF para registrar usuario. EXCEPTION: ' . $e . '  Desde la IP:' . $remote_addr . ' Al cliente (RIF):' . $rif . '', 'EXCEPTION');
}
?>
