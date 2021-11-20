<?php
    function function_Perfil($codPerfil)
    {
        switch($codPerfil){
            case ADMIN:
                return "Administrador";
            break;

            case PRESIDENTE:
                return "Presidente";
            break;

            case VICE_PRESIDENTE:
                return "Vice-Presidente";
            break;

            case SECRETARIO:
                return "Secretario";
            break;

            case SOCIO:
                return "Sócio";
            break;

            case POR_VALIDAR:
                return "Por validar";
            break;

            case DESATIVADO:
                return "Desativado";
            break;
            
            default:
                return "Desconhecido";
            break;
        }
    }
?>