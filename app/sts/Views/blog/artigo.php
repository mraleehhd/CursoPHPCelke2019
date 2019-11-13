
<?php
if (!defined("URL")):
    header("Location: /");
    exit();
endif;
?>
<main role="main">


    <div class="jumbotron blog">
        <div class="container">
            <div class="row">
                <div class="col-md-8 blog-main">

                    <?php
                    if (!empty($this->Dados['sts_artigos'][0])):
                        extract($this->Dados['sts_artigos'][0])
                        ?>
                        <div class="blog-post">
                            <h2 class="blog-post-title"><?= $titulo; ?></h2>
                            <img src="<?= URL . 'assets/imgs/artigo/' . $id . '/' . $imagem; ?>" class="img-fluid" alt="Responsive image" style="margin-bottom: 20px">
                            <?= $conteudo; ?>
                        </div>

                        <nav class="blog-pagination">
                            <?php
                            if (!empty($this->Dados['artAnterior'][0])):
                                extract($this->Dados['artAnterior'][0]);
                                echo "<a class='btn btn-outline-primary' href='" . URL . "artigo/$slug'>Anterior</a>";
                            else:
                                echo "<a class='btn btn-outline-secondary disabled' href='#'>Anterior</a>";
                            endif;
                            if (!empty($this->Dados['artProximo'][0])):
                                extract($this->Dados['artProximo'][0]);
                                echo "<a class='btn btn-outline-primary' href='" . URL . "artigo/$slug'>Próximo</a>";
                            else:
                                echo "<a class='btn btn-outline-secondary disabled' href='#'>Próximo</a>";
                            endif;
                            ?>

                        </nav>
                        <?php
                    else:

                        echo "<div class='alert alert-danger'>Erro: Nenhum artigo cadastrado!</div>";

                    endif;
                    ?>



                </div>
                <aside class="col-md-4 blog-sidebar">
                    <?php if (!empty($this->Dados['sobreAutor'][0])): ?>
                        <div class="p-3 mb-3 bg-light rounded">
                            <?php
                            extract($this->Dados['sobreAutor'][0]);
                            ?>
                            <h4 class="font-italic"><?= $titulo; ?></h4>
                            <img src="<?= URL . 'assets/imgs/sobre_autor/' . $id . '/' . $imagem; ?>" class="img-fluid rounded-circle" width="50%" alt="<?= $titulo; ?>">
                            <p class="mb-0"><?= $descricao; ?></p> 

                        </div>
                    <?php endif; ?>

                    <div class="p-3">
                        <h4 class="font-italic">Recentes</h4>
                        <ol class="list-unstyled mb-0">
                            <?php
                            foreach ($this->Dados['artRecente'] as $artigoRec) {
                                extract($artigoRec);
                                echo "<li><a href='" . URL . "artigo/$slug'>{$titulo}</a></li>";
                            }
                            ?>
                        </ol>
                    </div>

                    <div class="p-3">
                        <h4 class="font-italic">Destaques</h4>
                        <ol class="list-unstyled">
                            <?php
                            foreach ($this->Dados['artDestaque'] as $artigoDes) {
                                extract($artigoDes);
                                echo "<li><a href='" . URL . "artigo/$slug'>{$titulo}</a></li>";
                            }
                            ?>
                        </ol>
                    </div>
                </aside><!-- /.blog-sidebar -->
            </div>
        </div>
    </div>

</main>
