<?php
if (!defined("URL")):
    header("Location: /");
    exit();
endif;
?>
<main role="main">



    <div class="jumbotron contato">
        <div class="container">
            <h2 class="display-4 text-center" style="margin-bottom: 40px;">Contato</h2>
            <?php
            if (isset($_SESSION['msg'])):
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            endif;
            
            if(isset($this->Dados['form'])):
                $valorForm = $this->Dados['form'];
            endif;
            ?>
            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nome</label>
                        <input name="nome" type="text" class="form-control" placeholder="Nome completo" value="<?php if(isset($valorForm['nome'])) { echo $valorForm['nome'];}?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>E-mail</label>
                        <input name="email" type="email" class="form-control" placeholder="Seu melhor e-mail" value="<?php if(isset($valorForm['email'])) { echo $valorForm['email'];}?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Assunto</label>
                    <input name="assunto" type="text" class="form-control" placeholder="Assunto da mensagem" value="<?php if(isset($valorForm['assunto'])) { echo $valorForm['assunto'];}?>">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Mensagem</label>
                    <textarea name="mensagem" class="form-control" rows="6"><?php if(isset($valorForm['mensagem'])) { echo $valorForm['mensagem'];}?></textarea>
                </div>
                <input name="created" type="hidden" value="<?= date("Y-m-d H:i:s"); ?>">

                <input name="CadMsgCont" type="submit" class="btn btn-danger" value="Enviar">
            </form>

        </div>
    </div>

</main>