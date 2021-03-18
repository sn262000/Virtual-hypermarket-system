<?php
error_reporting(E_ERROR | E_PARSE);
include_once 'connect.php';
$ns = $_POST['q1'];

function RemoveSpecialChar($ns) { 
    $res = preg_replace('/[^a-zA-Z0-9_ -]/s',' ',$ns);
    return $res; 
} 
  
$names = RemoveSpecialChar($ns);

$sql5 = "DELETE FROM `checking`";
$result5 = mysqli_query($conn,$sql5);

$sql6 = "INSERT INTO `checking` values('$names')";
$result6 = mysqli_query($conn,$sql6);

$sql7 = "UPDATE checking SET Extraction=(SELECT REPLACE(Extraction, '\r', ' ') from checking)";
$result7 = mysqli_query($conn,$sql7); 

$sql8 = "UPDATE checking SET Extraction=(SELECT REPLACE(Extraction, '\n', ' ') from checking)";
$result8 = mysqli_query($conn,$sql8); 

$sql9 = "UPDATE checking SET Extraction=(SELECT REPLACE(Extraction, '  ', ' ') from checking)";
$result9 = mysqli_query($conn,$sql9); 


$ext = "SELECT * FROM `checking`";
$result3 = mysqli_query($conn,$ext);

$value = mysqli_fetch_array($result3,MYSQLI_ASSOC);
$abc = $value['Extraction'];

$sql10 = "SELECT ID,name FROM `grocery` WHERE LOCATE(name,'$abc')>0";
$results10 = mysqli_query($conn,$sql);
$row10 = mysqli_fetch_array($results10);




$sql = "SELECT * FROM `grocery` WHERE LOCATE(name,'$abc')>0";
$results = mysqli_query($conn,$sql);
//$row = mysqli_fetch_array($results);


if(isset($_POST['txt'])){
    $txt=$_POST['txt'];
    $txt=substr($txt,0,50);
    $txt=htmlspecialchars($txt);
    $txt=rawurlencode($txt);
    $html=file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txt.'&tl=en-IN');
    $player="<audio controls='controls' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
    echo $player;
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>PRODUCT DETAILS</title>
    <meta charset="UTF-8" />   
    <link href="ratekit/css/ratekit.min.css" type="text/css" rel="stylesheet">

    <style type="text/css">
        body {
            font-size: 15px;
            color: #343d44;
            font-family: "segoe-ui", "open-sans", tahoma, arial;
            padding: 0;
            margin: 0;
            background-image: url('bg3.jpg');
        }

        .header a{
            padding: 0px 10px;
            letter-spacing: 1px;
            color: #ddd;
            display: block;
            float: left;
        }
        .header a:hover{
            color: #fff;
        }
        .header span.right{
            float: right;
        }
        .header span.right a{
            float: none;
            display: inline;
        }

        table {
            margin: auto;
            font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
            font-size: 12px;
        }

        h1 {
            margin: 25px auto 0;
            text-align: center;
            text-transform: uppercase;
            font-size: 25px;
            color:black;
        }

        table td {
            transition: all .5s;
        }

        

        /* Table */
        .data-table {
            border-collapse: collapse;
            font-size: 14px;
            min-width: 537px;
        }

        .data-table tr
        {
            color:black;
        }

        .data-table th {
            background-color:white;
            border: 2px solid #1a0105;
            padding: 7px 10px;

        }
        .data-table td {
            border: 2px solid #1a0105;
            padding: 7px 10px;
        }

        .data-table caption {
            margin: 7px;
        }

        /* Table Header */
        .data-table thead th {
            background-color: white;
            color: black;
            border-color: black !important;
            text-transform: uppercase;
        }

        /* Table Body */
        .data-table tbody td {
            color: #0a0808;
        }

        .data-table tbody td:first-child,
        .data-table tbody td:nth-child(4),
        .data-table tbody td:last-child {
            text-align: center;
        }

        .data-table tbody tr:nth-child(odd) td {
            background-color: #7ec8f2;
        }

        .data-table tbody tr:nth-child(even) td {
            background-color: #b0ffd0;
        }

        .data-table tbody tr:hover td {
            background-color: #fcfc58;
            border-color: #ffff0f;

        }

        .data-table tfoot th:first-child {
            text-align: left;

        }

        .data-table tbody td:empty {
            background-color: #ffcccc;
        }
    </style>
</head>

<body>
    <h1>GROCERY PRODUCT DETAILS</h1>
    <br></br>
    <center>
    <div id="player"></div>
    <form method="post">
        <textarea id="txt" name="txt" ><?php echo $names;?></textarea>
        <br></br>
        <input type="button" name="submit" value="Hear it OUT" onclick="getAudio()"/>
    </form>
</center>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
    function getAudio(){
        var txt=jQuery('#txt').val()
        jQuery.ajax({
            url:'get.php',
            type:'post',
            data:'txt='+txt,
            success:function(result){
                jQuery('#player').html(result);
            }
        });
    }
    </script>


    <div class="header">
        <span class="right">
            <a href="http://localhost/cip/gfirstpage.html"><strong>Back</strong></a>
        </span>
    <div class="clr"></div>
    </div>
    <table class="data-table">
        <caption class="title" style="font-size: 17px; color:black">PRODUCT DATA</caption>
        <thead>
            <tr>
                <th>Details</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if ($row = mysqli_fetch_array($results))
        {
            ?>
            <br>
            <tr>
                <th>ID</th>
                <td><?php echo $row[ID];?></td>
            </tr>

            <tr>
                <th>PRODUCT NAME</th>
                <td><?php echo $row[name]; ?></td>
                
            </tr>

            <tr>
                <th>FOOD GROUP</th>
                <td><?php echo $row[Food_Group];?></td>
            </tr>

            <tr>
                <th>PRICE</th>
                <td><?php echo $row[Price];?></td>
            </tr>

            <tr>
                <th>CALORIES</th>
                <td><?php echo $row[Calories]; ?></td>
                
            </tr>
            <?php
            if($row[Fat_g]!="NULL"){
                ?>
            <tr>
                <th>FATS(in gms)</th>
                <td><?php echo $row[Fat_g];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Protein_g]!="NULL"){
                ?>
            <tr>
                <th>PROTEIN(in gms)</th>
                <td><?php echo $row[ Protein_g]; ?></td>
                
            </tr>
            <?php } ?>



            <?php
            if($row[Carbohydrate_g]!="NULL"){
                ?>
            <tr>
                <th>CARBOHYDRATES(in gms)</th>
                <td><?php echo $row[Carbohydrate_g];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Sugars_g]!="NULL"){
                ?>
            <tr>
                <th>SUGARS(in gms)</th>
                <td><?php echo $row[Sugars_g]; ?></td>
                
            </tr>
            <?php } ?>





            <?php
            if($row[Fiber_g]!="NULL"){
                ?>
            <tr>
                <th>FIBER(in gms)</th>
                <td><?php echo $row[Fiber_g];?></td>
            </tr>
            <?php } ?>




            <?php
            if($row[Cholesterol_mg]!="NULL"){
                ?>
            <tr>
                <th>CHOLESTEROL(in mg)</th>
                <td><?php echo $row[Cholesterol_mg]; ?></td>
                
            </tr>
            <?php } ?>




            <?php
            if($row[Saturated_Fats_g]!="NULL"){
                ?>
            <tr>
                <th>SATURATED_FATS(in gms)</th>
                <td><?php echo $row[Saturated_Fats_g];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Calcium_mg]!="NULL"){
                ?>
            <tr>
                <th>CALCIUM(in mg)</th>
                <td><?php echo $row[Calcium_mg]; ?></td>
                
            </tr>
            <?php } ?>



            <?php
            if($row[Iron_Fe_mg]!="NULL"){
                ?>
            <tr>
                <th>IRON(in mg)</th>
                <td><?php echo $row[Iron_Fe_mg];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Potassium_K_mg]!="NULL"){
                ?>
            <tr>
                <th>POTASSIUM(in mg)</th>
                <td><?php echo $row[Potassium_K_mg]; ?></td>
                
            </tr>
            <?php } ?>


            <?php
            if($row[Magnesium_mg]!="NULL"){
                ?>
            <tr>
                <th>MAGNESIUM(in mg)</th>
                <td><?php echo $row[Magnesium_mg];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Vitamin_A_IU_IU]!="NULL"){
                ?>
            <tr>
                <th>VITAMIN A IU</th>
                <td><?php echo $row[Vitamin_A_IU_IU]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Vitamin_A_RAE_mcg]!="NULL"){
                ?>
            <tr>
                <th>VITAMIN A RAE</th>
                <td><?php echo $row[Vitamin_A_RAE_mcg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Vitamin_C_mg]!="NULL"){
                ?>
            <tr>
                <th>VITAMIN C(in mg)</th>
                <td><?php echo $row[Vitamin_C_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Vitamin_B_12_mcg]!="NULL"){
                ?>
            <tr>
                <th>VITAMIN B12(in mcg)</th>
                <td><?php echo $row[Vitamin_B_12_mcg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Vitamin_D_mcg]!="NULL"){
                ?>
            <tr>
                <th>VITAMIN D(in mcg)</th>
                <td><?php echo $row[Vitamin_D_mcg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Vitamin_E_Alpha_Tocopherol_mg]!="NULL"){
                ?>
            <tr>
                <th>VITAMIN E Alpha Tocopherol(in mg)</th>
                <td><?php echo $row[Vitamin_E_Alpha_Tocopherol_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Added_Sugar_g]!="NULL"){
                ?>
            <tr>
                <th>ADDED SUGARS (in gms)</th>
                <td><?php echo $row[Added_Sugar_g]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Net_Carbs_g]!="NULL"){
                ?>
            <tr>
                <th>NET CARBOHYDRATES(in gms)</th>
                <td><?php echo $row[Net_Carbs_g];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Water_g]!="NULL"){
                ?>
            <tr>
                <th>WATER(in gms)</th>
                <td><?php echo $row[Water_g]; ?></td>
                
            </tr>
            <?php } ?>

        <?php
            if($row[Omega_3s_mg]!="NULL"){
                ?>
            <tr>
                <th>OMEGA 3s(in mg)</th>
                <td><?php echo $row[Omega_3s_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Omega_6s_mg]!="NULL"){
                ?>
            <tr>
                <th>OMEGA 6s(in mg)</th>
                <td><?php echo $row[Omega_6s_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[PRAL_score]!="NULL"){
                ?>
            <tr>
                <th>PRAL SCORE</th>
                <td><?php echo $row[PRAL_score];?></td>
            </tr>
            <?php } ?>


            <?php
            if($row[Trans_Fatty_Acids_g]!="NULL"){
                ?>
            <tr>
                <th>TRANS FATTY ACIDS(in gms)</th>
                <td><?php echo $row[Trans_Fatty_Acids_g];?></td>
                
            </tr>
            <?php
            }?>



            <?php
            if($row[Soluble_Fiber_g]!="NULL"){
                ?>
            <tr>
                <th>SOLUBLE FIBER(in gms)</th>
                <td><?php echo $row[Soluble_Fiber_g];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Insoluble_Fiber_g]!="NULL"){
                ?>
            <tr>
                <th>INSOLUBLE FIBER(in gms)</th>
                <td><?php echo $row[Insoluble_Fiber_g]; ?></td>
                
            </tr>
            <?php } ?>



            <?php
            if($row[Sucrose_g]!="NULL"){
                ?>
            <tr>
                <th>SUCROSE(in gms)</th>
                <td><?php echo $row[Sucrose_g];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Glucose_Dextrose_g]!="NULL"){
                ?>
            <tr>
                <th>GLUCOSE DEXTROSE(in gms)</th>
                <td><?php echo $row[Glucose_Dextrose_g]; ?></td>
                
            </tr>
            <?php } ?>



            <?php
            if($row[Fructose_g]!="NULL"){
                ?>
            <tr>
                <th>FRUCTOSE(in gms)</th>
                <td><?php echo $row[Fructose_g];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Lactose_g]!="NULL"){
                ?>
            <tr>
                <th>LACTOSE(in gms)</th>
                <td><?php echo $row[Lactose_g]; ?></td>
                
            </tr>
            <?php } ?>



            <?php
            if($row[Maltose_g]!="NULL"){
                ?>
            <tr>
                <th>MALTOSE(in gms)</th>
                <td><?php echo $row[Maltose_g];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Galactose_g]!="NULL"){
                ?>
            <tr>
                <th>GALACTOSE(in gms)</th>
                <td><?php echo $row[Galactose_g]; ?></td>
                
            </tr>
            <?php } ?>



            <?php
            if($row[Starch_g]!="NULL"){
                ?>
            <tr>
                <th>STARCH(in gms)</th>
                <td><?php echo $row[Starch_g];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Total_sugar_alcohols_g]!="NULL"){
                ?>
            <tr>
                <th>TOTAL SUGAR ALCOHOLS(in gms)</th>
                <td><?php echo $row[Total_sugar_alcohols_g];?></td>
            </tr>
            <?php } ?>


            <?php
            if($row[Phosphorus_P_mg]!="NULL"){
                ?>
            <tr>
                <th>PHOSPHORUS(in mg)</th>
                <td><?php echo $row[Phosphorus_P_mg]; ?></td>
                
            </tr>
            <?php } ?>



            <?php
            if($row[Sodium_mg]!="NULL"){
                ?>
            <tr>
                <th>SODIUM(in mg)</th>
                <td><?php echo $row[Sodium_mg];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Zinc_Zn_mg]!="NULL"){
                ?>
            <tr>
                <th>ZINC(in mg)</th>
                <td><?php echo $row[Zinc_Zn_mg]; ?></td>
                
            </tr>
            <?php } ?>



            <?php
            if($row[Copper_Cu_mg]!="NULL"){
                ?>
            <tr>
                <th>COPPER(in mg)</th>
                <td><?php echo $row[Copper_Cu_mg];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Manganese_mg]!="NULL"){
                ?>
            <tr>
                <th>MANGANESE(in mg)</th>
                <td><?php echo $row[Manganese_mg]; ?></td>
                
            </tr>
            <?php } ?>



            <?php
            if($row[Selenium_Se_mcg]!="NULL"){
                ?>
            <tr>
                <th>SELENIUM(in mcg)</th>
                <td><?php echo $row[Selenium_Se_mcg];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Fluoride_F_mcg]!="NULL"){
                ?>
            <tr>
                <th>FLUORIDE(in mcg)</th>
                <td><?php echo $row[Fluoride_F_mcg]; ?></td>
                
            </tr>
            <?php } ?>



            <?php
            if($row[Molybdenum_mcg]!="NULL"){
                ?>
            <tr>
                <th>MOLYBDENUM(in mcg)</th>
                <td><?php echo $row[Molybdenum_mcg];?></td>
            </tr>
            <?php } ?>



            <?php
            if($row[Chlorine_mg]!="NULL"){
                ?>
            <tr>
                <th>CHLORINE(in mg)</th>
                <td><?php echo $row[Chlorine_mg]; ?></td>
                
            </tr>
            <?php } ?>



            <?php
            if($row[Thiamin_B1_mg]!="NULL"){
                ?>
            <tr>
                <th>THIAMINE B1(in mg)</th>
                <td><?php echo $row[Thiamin_B1_mg];?></td>
            </tr>
            <?php } ?>

           
            <?php
            if($row[Riboflavin_B2_mg]!="NULL"){
                ?>
            <tr>
                <th>RIBOFLAVIN B2(in mg)</th>
                <td><?php echo $row[Riboflavin_B2_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Niacin_B3_mg]!="NULL"){
                ?>
            <tr>
                <th>NIACIN B3(in mg)</th>
                <td><?php echo $row[Niacin_B3_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Pantothenic_acid_B5_mg]!="NULL"){
                ?>
            <tr>
                <th>PANTOTHENIC ACID(in mg)</th>
                <td><?php echo $row[Pantothenic_acid_B5_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Vitamin_B6_mg]!="NULL"){
                ?>
            <tr>
                <th>VITAMIN B6(in mg)</th>
                <td><?php echo $row[Vitamin_B6_mg];?></td>
            </tr>
            <?php } ?>


            <?php
            if($row[Biotin_B7_mcg]!="NULL"){
                ?>
            <tr>
                <th>BIOTIN B7(in mcg)</th>
                <td><?php echo $row[Biotin_B7_mcg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Folate_B9_mcg]!="NULL"){
                ?>
            <tr>
                <th>FOLATE B9(in mcg)</th>
                <td><?php echo $row[Folate_B9_mcg];?></td>
            </tr>
            <?php } ?>


            <?php
            if($row[Folic_acid_mcg]!="NULL"){
                ?>
            <tr>
                <th>FOLIC ACID(in mcg)</th>
                <td><?php echo $row[Folic_acid_mcg]; ?></td>
                
            </tr>
            <?php } ?>


        
            <?php
            if($row[Food_Folate_mcg]!="NULL"){
                ?>
            <tr>
                <th>FOOD FOLATE(in mcg)</th>
                <td><?php echo $row[Food_Folate_mcg];?></td>
            </tr>
            <?php } ?>


            <?php
            if($row[Folate_DFE_mcg]!="NULL"){
                ?>
            <tr>
                <th>FOLATE DFE(in mcg)</th>
                <td><?php echo $row[Folate_DFE_mcg]; ?></td>
                
            </tr>
            <?php } ?>


            <?php
            if($row[Choline_mg]!="NULL"){
                ?>
            <tr>
                <th>CHOLINE(in mg)</th>
                <td><?php echo $row[Choline_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Betaine_mg]!="NULL"){
                ?>
            <tr>
                <th>BETAINE(in mg)</th>
                <td><?php echo $row[Betaine_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Retinol_mcg]!="NULL"){
                ?>
            <tr>
                <th>RETINOL(in mcg)</th>
                <td><?php echo $row[Retinol_mcg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Carotene_beta_mcg]!="NULL"){
                ?>
            <tr>
                <th>CAROTENE BETA(in mcg)</th>
                <td><?php echo $row[Carotene_beta_mcg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Carotene_alpha_mcg]!="NULL"){
                ?>
            <tr>
                <th>CAROTENE ALPHA(in mcg)</th>
                <td><?php echo $row[Carotene_alpha_mcg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Lycopene_mcg]!="NULL"){
                ?>
            <tr>
                <th>LYCOPENE(in mg)</th>
                <td><?php echo $row[Lycopene_mcg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Lutein_Zeaxanthin_mcg]!="NULL"){
                ?>
            <tr>
                <th>LUTEIN ZEAXANTHIN(in mcg)</th>
                <td><?php echo $row[Lutein_Zeaxanthin_mcg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Vitamin_D2_ergocalciferol_mcg]!="NULL"){
                ?>
            <tr>
                <th>VITAMIN D2</th>
                <td><?php echo $row[Vitamin_D2_ergocalciferol_mcg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Vitamin_D3_cholecalciferol_mcg]!="NULL"){
                ?>
            <tr>
                <th>VITAMIN D3</th>
                <td><?php echo $row[Vitamin_D3_cholecalciferol_mcg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Vitamin_D_IU_IU]!="NULL"){
                ?>
            <tr>
                <th>VITAMIN D</th>
                <td><?php echo $row[Vitamin_D_IU_IU]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Vitamin_K_mcg]!="NULL"){
                ?>
            <tr>
                <th>VITAMIN K</th>
                <td><?php echo $row[Vitamin_K_mcg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Dihydrophylloquinone_mcg]!="NULL"){
                ?>
            <tr>
                <th>DIHYDROPHYLLOQUINONE(in mg)</th>
                <td><?php echo $row[Dihydrophylloquinone_mcg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Menaquinone_4_mcg]!="NULL"){
                ?>
            <tr>
                <th>MENAQUINONE(in mg)</th>
                <td><?php echo $row[Menaquinone_4_mcg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Fatty_acids_total_monounsaturated_mg]!="NULL"){
                ?>
            <tr>
                <th>FATTY ACID MONOUNSATURATED (in mg)</th>
                <td><?php echo $row[Fatty_acids_total_monounsaturated_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Fatty_acids_total_polyunsaturated_mg]!="NULL"){
                ?>
            <tr>
                <th>FATTY ACID POLYUNSATURATED (in mg)</th>
                <td><?php echo $row[Fatty_acids_total_polyunsaturated_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Column_18_3_n_3_c_c_c_ALA_mg]!="NULL"){
                ?>
            <tr>
                <th>ALA(in mg)</th>
                <td><?php echo $row[Column_18_3_n_3_c_c_c_ALA_mg]; ?></td>
                
            </tr>
            <?php } ?>
 

            <?php
            if($row[Column_20_5_n_3_EPA_mg]!="NULL"){
                ?>
            <tr>
                <th>EPA(in mg)</th>
                <td><?php echo $row[Column_20_5_n_3_EPA_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Column_22_5_n_3_DPA_mg]!="NULL"){
                ?>
            <tr>
                <th>DPA(in mg)</th>
                <td><?php echo $row[Column_22_5_n_3_DPA_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Column_22_6_n_3_DHA_mg]!="NULL"){
                ?>
            <tr>
                <th>DHA(in mg)</th>
                <td><?php echo $row[Column_22_6_n_3_DHA_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Tryptophan_mg]!="NULL"){
                ?>
            <tr>
                <th>TRYPTOPHAN(in mg)</th>
                <td><?php echo $row[Tryptophan_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Threonine_mg]!="NULL"){
                ?>
            <tr>
                <th>THREONINE(in mg)</th>
                <td><?php echo $row[Threonine_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Isoleucine_mg]!="NULL"){
                ?>
            <tr>
                <th>ISOLECUCINE(in mg)</th>
                <td><?php echo $row[Isoleucine_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Leucine_mg]!="NULL"){
                ?>
            <tr>
                <th>LEUCINE(in mg)</th>
                <td><?php echo $row[Leucine_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Lysine_mg]!="NULL"){
                ?>
            <tr>
                <th>LYSINE(in mg)</th>
                <td><?php echo $row[Lysine_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Methionine_mg]!="NULL"){
                ?>
            <tr>
                <th>METHIONINE(in mg)</th>
                <td><?php echo $row[Methionine_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Cystine_mg]!="NULL"){
                ?>
            <tr>
                <th>CYSTINE(in mg)</th>
                <td><?php echo $row[Cystine_mg];?></td>
            </tr>
            <?php } ?>


            <?php
            if($row[Phenylalanine_mg]!="NULL"){
                ?>
            <tr>
                <th>PHENYLALANINE(in mg)</th>
                <td><?php echo $row[Phenylalanine_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Tyrosine_mg]!="NULL"){
                ?>
            <tr>
                <th>TYROSINE(in mg)</th>
                <td><?php echo $row[Tyrosine_mg];?></td>
            </tr>
            <?php } ?>


            <?php
            if($row[Valine_mg]!="NULL"){
                ?>
            <tr>
                <th>VALINE(in mg)</th>
                <td><?php echo $row[Valine_mg]; ?></td>
                
            </tr>
            <?php } ?>


            <?php
            if($row[Arginine_mg]!="NULL"){
                ?>
            <tr>
                <th>ARGININE(in mg)</th>
                <td><?php echo $row[Arginine_mg];?></td>
            </tr>
            <?php } ?>


            <?php
            if($row[Histidine_mg]!="NULL"){
                ?>
            <tr>
                <th>HISTIDINE(in mg)(in mg)</th>
                <td><?php echo $row[Histidine_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Alanine_mg]!="NULL"){
                ?>
            <tr>
                <th>ALANINE (in mg)</th>
                <td><?php echo $row[Alanine_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Aspartic_acid_mg]!="NULL"){
                ?>
            <tr>
                <th>ASPARTIC ACID(in mg)</th>
                <td><?php echo $row[Aspartic_acid_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Glutamic_acid_mg]!="NULL"){
                ?>
            <tr>
                <th>GLUTAMIC ACID(in mg)</th>
                <td><?php echo $row[Glutamic_acid_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Glycine_mg]!="NULL"){
                ?>
            <tr>
                <th>GLYCINE(in mg)</th>
                <td><?php echo $row[Glycine_mg];?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Proline_mg]!="NULL"){
                ?>
            <tr>
                <th>PROLINE(in mg)</th>
                <td><?php echo $row[Proline_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Serine_mg]!="NULL"){
                ?>
            <tr>
                <th>SERINE(in mg)</th>
                <td><?php echo $row[Serine_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Hydroxyproline_mg]!="NULL"){
                ?>
            <tr>
                <th>HYDROXYPROLINE(in mg)</th>
                <td><?php echo $row[Hydroxyproline_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Alcohol_g]!="NULL"){
                ?>
            <tr>
                <th>ALCOHOL(in g)</th>
                <td><?php echo $row[Alcohol_g]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Caffeine_mg]!="NULL"){
                ?>
            <tr>
                <th>CAFFEINE(in mg)</th>
                <td><?php echo $row[Caffeine_mg];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Theobromine_mg]!="NULL"){
                ?>
            <tr>
                <th>THEOBROMINE(in mg)</th>
                <td><?php echo $row[Theobromine_mg]; ?></td>
                
            </tr>
            <?php } ?>

            <?php
            if($row[Serving_Weight_1_g]!="NULL"){
                ?>
            <tr>
                <th>SERVING WEIGHT(in g)</th>
                <td><?php echo $row[Serving_Weight_1_g];?></td>
            </tr>
            <?php } ?>

            <?php
            if($row[Column_200_Calorie_Weight_g]!="NULL"){
                ?>
            <tr>
                <th>CALORIE WEIGHT(in g)</th>
                <td><?php echo $row[Column_200_Calorie_Weight_g]; ?></td>
                
            </tr>
            <?php } ?>
           

            
            <?php
            }

            ?>
        </tbody>
    </table>
    <!--<center>
         <a href="http://localhost/cip/index1.php"><button>CLICK HERE TO RATE RATINGS</button></a>    
    </center>-->
    <br></br>
    <center>
        <form action=index1.php method="POST" target="print_popup" onsubmit="window.open('about:blank','print_popup','width=400,height=400');">
            <label for="fn" style="color: white">PRODUCT ID</label><br>
            <input type="text" id="fn" name="fn" value="<?php echo $row[ID];?>" readonly><br>
            <br></br>
            <input type="submit" value="Click to rate and view ratings">
        </form>
    </center>

    <br></br>
    <!--<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="ratekit/js/ratekit.min.js"></script>-->
</body>
</html>