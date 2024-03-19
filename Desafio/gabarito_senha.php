<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adivinhando a senha</title>
</head>
<body>
<?php
if (isset($_POST['senha'])){  //verifica se há um valor enviado via método POST com o nome de 'senha'. Isso é usado para verificar se o formulário foi submetido.
    $senha = $_POST['senha']; 
    if ($senha === 'admin123') {
        echo 'Senha correta';
    } else {
        echo 'Senha incorreta';
    }
}
$file = fopen("passwords.txt", "a"); 
    fwrite($file, $senha . "\n"); //abre escreve e fecha
    fclose($file); 

?>
</body>
</html>
