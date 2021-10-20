<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Revenda de Carros";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $busca = isset($_POST['busca']) ? $_POST['busca'] : 1;
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link rel="stylesheet" href="css/estilo.css">
   
</head>
<body>
<?php include "menu.php"; ?>
    <form method="post">
    <fieldset>
        <legend>Procurar Carros</legend>

        <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
        <input type="submit" name="acao"     id="acao">
        <br><br>
        
        <table>
	    <tr><td><b>Código</b></td>
            <td><b>Nome</b></td>
            <td><b>Valor</b></td>
            <td><b>KM</b></td>
            <td><b>Data de fabricação</b></td>
            <td><b>Anos de uso</b></td>
            <td><b>Média de KM por ano</b></td>
            <td><b>Preço final de revenda</b></td>

        </tr> 

<fieldset>Ordernar e pesquisar por:<br>
<form method="post" action="">
        <input type="radio" name="busca" value="1" <?php if ($busca == "1") echo "checked" ?>>Nome<br>
        <input type="radio" name="busca" value="2" <?php if ($busca == "2") echo "checked" ?>>Valor<br>
        <input type="radio" name="busca" value="3" <?php if ($busca == "3") echo "checked" ?>>KM<br>
</fieldset>

</form>     

        <?php
            $pdo = Conexao::getInstance(); 
            
            if($busca == 1){
            $consulta = $pdo->query("SELECT * FROM carro 
                                     WHERE nome LIKE '$procurar%' 
                                     ORDER BY nome");}
            
            else if($busca == 2){
            $consulta = $pdo->query("SELECT * FROM carro 
                                WHERE valor <= '$procurar%' 
                                ORDER BY valor");}
            
            else if($busca == 3){
            $consulta = $pdo->query("SELECT * FROM carro 
                                     WHERE km <= '$procurar%' 
                                     ORDER BY km");}
            

            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            
            
            $hoje = date("Y");
            $uso = date("Y", strtotime($linha['dataFabricacao']));

            $idade = $hoje - $uso;

            $media = $linha['km']/$idade;

            $desconto = (10/100) * $linha['valor'];
            

            if($linha['km'] > 100000){
                $preco = $linha['valor'] - $desconto;
                $color ="red";
                
        } else {
        $preco = $linha['valor'];
        $color = "style =color: black'";}

            if($idade > 10){
            $precoF = $preco - $desconto;
            $color1 ="red";
            
        } else {$precoF = $preco;
            $color1 = "black";}


            

        ?>



	    <tr><td><?php echo $linha['id'];?></td>
            <td><?php echo $linha['nome'];?></td>
            <td <?php echo "style='color: $color'"?>><?php echo number_format ($linha['valor'], 1, ',', '.') ;?></td>
            <td><?php echo number_format ($linha['km'], 1, ',', '.');?></td>
            <td><?php echo date("d/m/Y",strtotime($linha['dataFabricacao']))
                ;?></td>
            <td <?php echo "style='color: $color1'"?>><?php echo $idade;?></td>
            <td><?php echo number_format ($media, 1, ',', '.');?>
            <td><?php echo $precoF;?></td>
	   
        </tr>
            <?php }?>       
        </table>
    </fieldset>
    </form>
</body>
</html>


