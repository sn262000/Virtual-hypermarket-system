<?php

include_once 'connect.php';
$names = $_POST['q1'];


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



$sql = "SELECT * FROM `grocery` WHERE LOCATE(name,'$abc')>0";
$result3 = mysqli_query($conn,$sql);
$row2 = mysqli_fetch_assoc($result3);

if($row2) {
    echo "id:" . $row2["ID"]. "<br>". "Name: " . $row2["name"]. "<br>". "Food_Group: " . $row2["Food_Group"]. "<br>";
    echo "Calories:" . $row2["Calories"]. "<br>". "Name: " . $row2["Fat_g"]. "<br>". "Food_Group: " . $row2["Protein_g"]. "<br>";
    echo "Carbohydrates(in gms):" . $row2["Carbohydrate_g"]. "<br>". "Name: " . $row2["Sugars_g"]. "<br>". "Food_Group: " . $row2["Fiber_g"]. "<br>";
    echo "Cholesterol(in mg):" . $row2["Cholesterol_mg"]. "<br>". "Name: " . $row2["Saturated_Fats_g"]. "<br>". "Food_Group: " . $row2["Calcium_mg"]. "<br>";
    echo "Iron(in mg):" . $row2["Iron_Fe_mg"]. "<br>". "Name: " . $row2["Potassium_K_mg"]. "<br>". "Food_Group: " . $row2["Magnesium_mg"]. "<br>";
    echo "Vitamin A:" . $row2["Vitamin_A_IU_IU"]. "<br>". "Name: " . $row2["Vitamin_A_RAE_mcg"]. "<br>". "Food_Group: " . $row2["Vitamin_C_mg"]. "<br>";
    echo "Vitamin B12(in mcg):" . $row2["Vitamin_B_12_mcg"]. "<br>". "Name: " . $row2["Vitamin_D_mcg"]. "<br>". "Food_Group: " . $row2["Vitamin_E_Alpha_Tocopherol_mg"]. "<br>";
    echo "Added Sugars(in gms):" . $row2["Added_Sugar_g"]. "<br>". "Name: " . $row2["Net_Carbs_g"]. "<br>". "Food_Group: " . $row2["Water_g"]. "<br>";
    echo "Omega_3s:" . $row2["Omega_3s_mg"]. "<br>". "Name: " . $row2["Omega_6s_mg"]. "<br>". "Food_Group: " . $row2["PRAL_score"]. "<br>";
    echo "Trans Fatty Acids(in gms):" . $row2["Trans_Fatty_Acids_g"]. "<br>". "Name: " . $row2["Soluble_Fiber_g"]. "<br>". "Food_Group: " . $row2["Insoluble_Fiber_g"]. "<br>";
    echo "Sucrose(in gms):" . $row2["Sucrose_g"]. "<br>". "Name: " . $row2["Glucose_Dextrose_g"]. "<br>". "Food_Group: " . $row2["Fructose_g"]. "<br>";
    echo "Lactose(in mgs):" . $row2["Lactose_g"]. "<br>". "Name: " . $row2["Maltose_g"]. "<br>". "Food_Group: " . $row2["Galactose_g"]. "<br>";
    echo "Starch(in gms):" . $row2["Starch_g"]. "<br>". "Name: " . $row2["Total_sugar_alcohols_g"]. "<br>". "Food_Group: " . $row2["Phosphorus_P_mg"]. "<br>";
    echo "Sodium(in mg):" . $row2["Sodium_mg"]. "<br>". "Name: " . $row2["Zinc_Zn_mg"]. "<br>". "Food_Group: " . $row2["Copper_Cu_mg"]. "<br>";
    echo "Manganese(in mg):" . $row2["Manganese_mg"]. "<br>". "Name: " . $row2["Fluoride_F_mcg"]. "<br>". "Food_Group: " . $row2["Molybdenum_mcg"]. "<br>";
    echo "Selenium(in mcg):" . $row2["Selenium_Se_mcg"]. "<br>". "Name: " . $row2["Chlorine_mg"]. "<br>". "Food_Group: " . $row2["Chlorine_mg"]. "<br>";

    echo "Thiamin B1(in mg):" . $row2["Thiamin_B1_mg"]. "<br>". "Name: " . $row2["Riboflavin_B2_mg"]. "<br>". "Food_Group: " . $row2["Niacin_B3_mg"]. "<br>";
    echo "Pantothenic acid B5(in mg):" . $row2["Pantothenic_acid_B5_mg"]. "<br>". "Name: " . $row2["Vitamin_B6_mg"]. "<br>". "Food_Group: " . $row2["Biotin_B7_mcg"]. "<br>";
    echo "Folate B9(in mcg):" . $row2["Folate_B9_mcg"]. "<br>". "Name: " . $row2["Folic_acid_mcg"]. "<br>". "Food_Group: " . $row2["Food_Folate_mcg"]. "<br>";
    echo "Folate DFE(in mcg):" . $row2["Folate_DFE_mcg"]. "<br>". "Name: " . $row2["Choline_mg"]. "<br>". "Food_Group: " . $row2["Betaine_mg"]. "<br>";
    echo "Retinol(in mcg):" . $row2["Retinol_mcg"]. "<br>". "Name: " . $row2["Carotene_beta_mcg"]. "<br>". "Food_Group: " . $row2["Carotene_alpha_mcg"]. "<br>";
    echo "Lycopene(in mcg):" . $row2["Lycopene_mcg"]. "<br>". "Name: " . $row2["Lutein_Zeaxanthin_mcg"]. "<br>". "Food_Group: " . $row2["Vitamin_D2_ergocalciferol_mcg"]. "<br>";
    echo "Vitamin D2 ergocalciferol(in mcg):" . $row2["Vitamin_D3_cholecalciferol_mcg"]. "<br>". "Name: " . $row2["Vitamin_D_IU_IU"]. "<br>". "Food_Group: " . $row2["Vitamin_K_mcg"]. "<br>";
    echo "Dihydrophylloquinone(in mcg):" . $row2["Dihydrophylloquinone_mcg"]. "<br>". "Name: " . $row2["Menaquinone_4_mcg"]. "<br>". "Food_Group: " . $row2["Fatty_acids_total_monounsaturated_mg"]. "<br>";
    echo "Fatty acids total polyunsaturated(in mg):" . $row2["Fatty_acids_total_polyunsaturated_mg"]. "<br>". "Name: " . $row2["Column_18_3_n_3_c_c_c_ALA_mg"]. "<br>". "Food_Group: " . $row2["Column_20_5_n_3_EPA_mg"]. "<br>";
    echo "DPA(in mg):" . $row2["Column_22_5_n_3_DPA_mg"]. "<br>". "Name: " . $row2["Column_22_6_n_3_DHA_mg"]. "<br>". "Food_Group: " . $row2["Tryptophan_mg"]. "<br>";
    echo "Threonine(in mg):" . $row2["Threonine_mg"]. "<br>". "Name: " . $row2["Isoleucine_mg"]. "<br>". "Food_Group: " . $row2["Leucine_mg"]. "<br>";
    echo "Lysine(in mg):" . $row2["Lysine_mg"]. "<br>". "Name: " . $row2["Methionine_mg"]. "<br>". "Food_Group: " . $row2["Cystine_mg"]. "<br>";
    echo "Phenylalanine(in mg):" . $row2["Phenylalanine_mg"]. "<br>". "Name: " . $row2["Tyrosine_mg"]. "<br>". "Food_Group: " . $row2["Valine_mg"]. "<br>";
    echo "Arginine(in mg):" . $row2["Arginine_mg"]. "<br>". "Name: " . $row2["Histidine_mg"]. "<br>". "Food_Group: " . $row2["Alanine_mg"]. "<br>";
    echo "Aspartic acid(in mg):" . $row2["Aspartic_acid_mg"]. "<br>". "Name: " . $row2["Glutamic_acid_mg"]. "<br>". "Food_Group: " . $row2["Glycine_mg"]. "<br>";
    echo "Proline(in mg):" . $row2["Proline_mg"]. "<br>". "Name: " . $row2["Serine_mg"]. "<br>". "Food_Group: " . $row2["Hydroxyproline_mg"]. "<br>";
    echo "Alcohol(in gms):" . $row2["Alcohol_g"]. "<br>". "Name: " . $row2["Caffeine_mg"]. "<br>". "Food_Group: " . $row2["Theobromine_mg"]. "<br>";
    echo "Serving Weight:" . $row2["Serving_Weight_1_g"]. "<br>". "Name: " . $row2["Column_200_Calorie_Weight_g"]. "<br>";
  }
mysqli_close($conn);
?>
 

 Calories
 Fat_g
 Protein_g
 Carbohydrate_g
 Sugars_g
 Fiber_g
 Cholesterol_mg
 Saturated_Fats_g
 Calcium_mg
 Iron_Fe_mg
 Potassium_K_mg
 Magnesium_mg
 Vitamin_A_IU_IU
 Vitamin_A_RAE_mcg
 Vitamin_C_mg
 Vitamin_B_12_mcg
 Vitamin_D_mcg
 Vitamin_E_Alpha_Tocopherol_mg
 Added_Sugar_g
 Net_Carbs_g
 Water_g
 Omega_3s_mg
 Omega_6s_mg
 PRAL_score
 Trans_Fatty_Acids_g
 Soluble_Fiber_g
 Insoluble_Fiber_g
 Sucrose_g
 Glucose_Dextrose_g
 Fructose_g
 Lactose_g
 Maltose_g
 Galactose_g
 Starch_g
 Total_sugar_alcohols_g
 Phosphorus_P_mg
 Sodium_mg
 Zinc_Zn_mg
 Copper_Cu_mg
 Manganese_mg
 Selenium_Se_mcg
 Fluoride_F_mcg
 Molybdenum_mcg
 Chlorine_mg
 Thiamin_B1_mg
 Riboflavin_B2_mg
 Niacin_B3_mg
 Pantothenic_acid_B5_mg
 Vitamin_B6_mg
 Biotin_B7_mcg
 Folate_B9_mcg
 Folic_acid_mcg
 Food_Folate_mcg
 Folate_DFE_mcg
 Choline_mg
 Betaine_mg
 Retinol_mcg
 Carotene_beta_mcg
 Carotene_alpha_mcg
 Lycopene_mcg
 Lutein_Zeaxanthin_mcg
 Vitamin_D2_ergocalciferol_mcg
 Vitamin_D3_cholecalciferol_mcg
 Vitamin_D_IU_IU
 Vitamin_K_mcg
 Dihydrophylloquinone_mcg
 Menaquinone_4_mcg
 Fatty_acids_total_monounsaturated_mg
 Fatty_acids_total_polyunsaturated_mg
 Column_18_3_n_3_c_c_c_ALA_mg
 Column_20_5_n_3_EPA_mg
 Column_22_5_n_3_DPA_mg
 Column_22_6_n_3_DHA_mg
 Tryptophan_mg
 Threonine_mg
 Isoleucine_mg
 Leucine_mg
 Lysine_mg
 Methionine_mg
 Cystine_mg
 Phenylalanine_mg
 Tyrosine_mg
 Valine_mg
 Arginine_mg
 Histidine_mg
 Alanine_mg
 Aspartic_acid_mg
 Glutamic_acid_mg
 Glycine_mg
 Proline_mg
 Serine_mg
 Hydroxyproline_mg
 Alcohol_g
 Caffeine_mg
 Theobromine_mg
 Serving_Weight_1_g
 Column_200_Calorie_Weight_g 