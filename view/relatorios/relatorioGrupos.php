<?php

//incluindo o arquivo do fpdf
require('fpdf/fpdf.php');

//defininfo a fonte !
define('FPDF_FONTPATH', 'fpdf/font/');

//instancia a classe.. P=Retrato, mm =tipo de medida utilizada no casso milimetros, tipo de folha =A4
$pdf = new FPDF("P", "cm", "A4");

$pdf->AddPage(); // Adiciona uma pagina
$pdf->AliasNbPages(); // Seleciona o número total de páginas, usado no rodape
// importa uma imagem
$pdf->Image("fpdf/tutorial/logo.png", 5, 0.5, 10, 2);
$pdf->Ln(2); // pula linha
// DEFINE A FONTE ARIAL, NEGRITO (B), DE TAMANHO 15
$pdf->SetFont("Arial", "B", 15);
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
$pdf->Cell(1, 0, "                                        Relatório de Grupos", 0, 1, 'L');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 12);
$pdo = new PDO('mysql:host=localhost; dbname=sgta', 'root', '');

// consulta as infomações do banco
$sql = $pdo->prepare("SELECT * FROM tb_grupo inner join tb_aluno on tb_grupo.id = tb_aluno.id_grupo where tb_aluno.id_grupo = id_grupo");
$sql->execute();


foreach ($sql as $resultado) {

    $pdf->Cell(0, 0.5, 'Nome: ' . $resultado['id_grupo'], 0, 1, 'L');
    $pdf->Cell(0, 0.5, 'Alunos: ' . $resultado['nome'], 0, 1, 'L');
    $pdf->Cell(0, 0.5, 'E-mail: ' . $resultado['email'], 0, 1, 'L');
    $pdf->Ln(0.2);
    $pdf->Cell(19, 0, '', 1, 1, 'L');
    $pdf->Ln(0.2);
}


//Definindo o rodapé
$pdf->SetFont('Arial', 'I', 8);

// Número de página
$pdf->Cell(0, 52, 'Página ' . $pdf->PageNo() . ' de {nb}', 0, 0, 'C');

//Posiciona verticalmente 26.6
$pdf->SetY(26.6);

//Data atual
$data = strftime("%d/%m/%Y às %T");
$conteudo = "criado em " . $data;
$texto = "por SGTA @Coporhit";

//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
$pdf->Cell(0, 0, '', 1, 1, 'L');
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
$pdf->Cell(0, 1, $texto, 0, 0, 'L');
//imprime uma celula... largura,altura, texto,borda,quebra de linha, alinhamento
$pdf->Cell(0, 1, $conteudo, 0, 1, 'R');

//Cria o arquivo em pdf
$pdf->Output('Relatorio_Grupos.pdf', 'D');
?>
