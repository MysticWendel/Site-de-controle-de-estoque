<?php 

    function mensagemAlerta(){
        if(isset($_SESSION['erro'])){
            echo  "<div class=\"alert alert-danger\">
                    <h5>". $_SESSION['erro'] ."</h5>
                </div>";
            unset($_SESSION['erro']);
        }
        
        if(isset($_SESSION['sucesso'])){
            echo  "<div class=\"alert alert-success\">
                    <h5>". $_SESSION['sucesso'] ."</h5>
                </div>";
            unset($_SESSION['sucesso']);
        }
    }
?>