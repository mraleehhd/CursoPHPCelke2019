<?php
if (!defined("URL")):
    header("Location: /");
    exit();
endif;
?>
<main role="main">



    <div class="jumbotron sobre-empresa">
        <div class="container">
            <h2 class="display-4 text-center" style="margin-bottom: 40px;">Sobre o desenvolvedor</h2>

            <?php
            $cont_sob_emp = 1;
            foreach ($this->Dados['sts_sobs_emp'] as $sobEmp):
                extract($sobEmp);
                if ($cont_sob_emp == 1):
                    ?>

                    <div class="row featurette">
                        <div class="col-md-7 order-md-2 anim_left">
                            <h2 class="featurette-heading"><?= $titulo; ?></h2>
                            <p class="lead"><?= $descricao; ?></p>
                        </div>
                        <div class="col-md-5 order-md-1 anim_top">
                            <img class="featurette-image img-fluid mx-auto" src="<?= URL . 'assets/imgs/sob_emp/' . $id . '/' . $imagem; ?>" alt="<?= $titulo; ?>">
                        </div>
                    </div>
                    <hr class="featurette-divider">
                    <?php
                    $cont_sob_emp = 2;
                else:
                    ?>
                    <div class="row featurette">
                        <div class="col-md-7 anim_right">
                            <h2 class="featurette-heading"><?= $titulo; ?></h2>
                            <p class="lead"><?= $descricao; ?></p>
                        </div>
                        <div class="col-md-5 anim_bottom">
                            <img class="featurette-image img-fluid mx-auto" src="<?= URL . 'assets/imgs/sob_emp/' . $id . '/' . $imagem; ?>" alt="<?= $titulo; ?>">
                        </div>
                    </div>
                    <hr class="featurette-divider">
                    <?php
                    $cont_sob_emp = 1;
                endif;
            endforeach;
            ?>

        </div>
    </div>

</main>