<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- medListar.php -->

<html>
<head>
    <title>SHIPPING</title>
    <link rel="icon" type="image/png" href="imagens/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body class="background">
<!-- Inclui MENU.PHP  -->
<?php require 'geral/menu.php'; ?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-top:5px;"">
    <div>
        <div class="w3-code cssHigh notranslate w3-yellow w3-round-large">
            <div class="w3-container w3-theme">
			<h2>Listagem de entregas</h2>
			</div>

            <!-- Acesso ao BD-->
            <?php

                // Cria conexão
                $conn = mysqli_connect($servername, $username, $password, $database);
                
                // Verifica conexão 
                if (!$conn) {
                    echo "</table>";
                    echo "</div>";
                    die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
                }

                // Configura para trabalhar com caracteres acentuados do português
                mysqli_query($conn,"SET NAMES 'utf8'");
                mysqli_query($conn,'SET character_set_connection=utf8');
                mysqli_query($conn,'SET character_set_client=utf8');
                mysqli_query($conn,'SET character_set_results=utf8');

                // Faz Select na Base de Dados
                $sql = "SELECT 
                        Entrega_ID, 
                        Nome,
                        Sobrenome,
                        Data_Recebimento, 
                        Data_Prevista_Entrega, 
                        Rua,
                        Numero,
                        CEP,
                        Complemento
                        FROM Entregas
                        INNER JOIN Funcionarios On Funcionarios.Matricula = Entregas.Fk_Funcionario_ID
                        INNER JOIN Destinos On Destinos.Destino_ID = Entregas.Fk_Destino_ID";
                echo "<div class='w3-responsive w3-card-4 w3-round-large'>";
                if ($result = mysqli_query($conn, $sql)) {
                    echo "<table class='w3-table-all w3-black'>";
                    echo "	<tr class='w3-black'>";
                    echo "	  <th width='10%'>Localizador</th>";
                    echo "	  <th width='10%'>Funcionario</th>";
                    echo "	  <th width='12%'>Data Recebimento</th>";
                    echo "	  <th width='16%'>Data de Entrega Prevista</th>";
                    echo "	  <th width='14%'>Rua</th>";
                    echo "	  <th width='10%'>Número</th>";
                    echo "	  <th width='8%'>CEP</th>";
                    echo "	  <th width='8%'>Complemento</th>";
                    echo "	</tr>";
                    if (mysqli_num_rows($result) > 0) {
                        // Apresenta cada linha da tabela
                        while ($row = mysqli_fetch_assoc($result)) {
                            $nomeFuncionario = $row['Nome'];
                            $sobrenomeFuncionario = $row['Sobrenome'];
                            $nomeCompleto = $nomeFuncionario." ".$sobrenomeFuncionario;
                            echo "<tr class='w3-sand'>";
                            echo "<td>";
                            echo $row['Entrega_ID'];
                            echo "</td><td>";
                            echo $nomeCompleto;
                            echo "</td><td>";
                            echo $row['Data_Recebimento'];
                            echo "</td><td>";
                            echo $row['Data_Prevista_Entrega'];
                            echo "</td><td>";
                            echo $row['Rua'];
                            echo "</td><td>";          
                            echo $row['Numero'];
                            echo "</td><td>";   
                            echo $row['CEP'];
                            echo "</td><td>";   
                            echo $row['Complemento'];
                            echo "</td><td>";   
                            //Atualizar e Excluir registro de médicos
            ?>              <td>       
                            <a href='medAtualizar.php?id=<?php echo $cod; ?>'><img src='imagens/Edit.png' title='Visualizar dados e editar da Entrega' width='32'></a>
                            </td><td>
                            <a href='medExcluir.php?id=<?php echo $cod; ?>'><img src='imagens/Delete.png' title='Remover entrega' width='32'></a>
                            </td>
                            </tr>
            <?php
                        }
                    }
                        echo "</table>";
                        echo "</div>";
                } else {
                    echo "Erro executando SELECT: " . mysqli_error($conn);
                }

                mysqli_close($conn);

            ?>
        </div>
    </div>
    
	<?php require 'geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php';?>

</body>
</html>