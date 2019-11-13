<?php
if (!defined("URL")):
    header("Location: /");
    exit();
endif;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        if (!empty($this->Dados['seo'][0])):
            extract($this->Dados['seo'][0]);
            echo "<title>{$titulo_site}</title> <br>";
            echo "<meta name='robots' content='$tipo_rob'>";
            echo "<meta name='description' content='{$description}'>";
            echo "<meta name='author' content='{$author}'>";
            echo "<meta name='canonical' content='" .URL ."{$endereco}'>";
            echo "<meta name='keywords' content='{$keywords}'>";
        endif;
        ?>
       
        <link rel="icon" href="<?= URL; ?>assets/imgs/icon/favicon.ico">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= URL; ?>assets/css/all.min.css">
        <link rel="stylesheet" href="<?= URL; ?>assets/css/style.css">
    </head>
    <body>
