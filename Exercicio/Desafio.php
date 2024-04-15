<?php
session_start();

class Pessoa
{
    public $nome;
    public $data_nasc;
    public $cpf;
    public $curso;
    public $periodo;

    public function __construct($nome, $data_nasc, $cpf, $curso, $periodo)
    {
        $this->nome = $nome;
        $this->data_nasc = $data_nasc;
        $this->cpf = $cpf;
        $this->curso = $curso;
        $this->periodo = $periodo;
    }
    public function exibir()
    {
        echo "Nome - " . $this->nome . "<br>";
        echo "Data de nascimento - " . $this->data_nasc . "<br>";
        echo "CPF - " . $this->cpf . "<br>";
        echo "Curso - " . $this->curso . "<br>";
        echo "Período - " . $this->periodo . "<br>";
    }
}

class SalaVirtual{
    public $professor;
    public $materia;

    public function Acrescentar($curso, $professor, $materia){   
        if ($curso == "dsm" || $curso == "DSM"){
            echo "Você está no curso de ".$curso."  E na melhor aula de segunda vendo ".$materia." com o professor  ".$professor."<br>";
        } else {
            echo "Está no curso errado";
        }
    }
}

$alunos = isset($_SESSION['alunos']) ? $_SESSION['alunos'] : [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['name'];
    $data_nasc = $_POST['date'];
    $cpf = $_POST['cpf'];
    $curso = $_POST['curso'];
    $periodo = $_POST['periodo'];

    $aluno = new Pessoa($nome, $data_nasc, $cpf, $curso, $periodo);

    $alunos[] = $aluno;

    $_SESSION['alunos'] = $alunos;

    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

if (isset($_GET['delete'])) {
    $delete_index = $_GET['delete'];
    if (array_key_exists($delete_index, $alunos)) {
        unset($alunos[$delete_index]);
        $_SESSION['alunos'] = $alunos;
    }
}

$diciplina = new SalaVirtual;
$diciplina->professor = "Orlando";
$diciplina->materia = "PHP OO";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio</title>
    <link rel="stylesheet" href="mark.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1 class="mt-5 mb-4">Formulário de Alunos</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input id="name" name="name" type="text" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="date" class="form-label">Data de Nascimento</label>
            <input id="date" name="date" type="date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input id="cpf" name="cpf" type="text" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="curso" class="form-label">Curso</label>
            <input id="curso" name="curso" type="text" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="periodo" class="form-label">Período</label>
            <input id="periodo" name="periodo" type="text" class="form-control" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Adicionar Aluno</button>
        </div>
    </form>

    <?php
    
    foreach ($alunos as $index => $aluno) {
        echo "<div class='aluno'>";
        echo "<h2 class='mt-5'>Aluno</h2>";
        echo "<div class='info-aluno'>";
        $aluno->exibir();
        $diciplina->Acrescentar($aluno->curso, $diciplina->professor, $diciplina->materia);
        echo "</div>"; 
        echo "<a href='?delete=$index' class='btn btn-danger'>Remover Aluno</a>";
        echo "</div>"; 
    }
    
        
    ?>
</div>
</body>
</html>
