<?php

$dbhost="localhost";
$dbuser="root";
$dbpass="";
$db="cip";

$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$db);
header('Content-Type: application/json');

$sqlQuery = "SELECT Calories, Fat_g, Protein_g, Carbohydrate_g, Sugars_g, Fiber_g, Cholesterol_mg, Saturated_Fats_g, Calcium_mg, Iron_Fe_mg, Potassium_K_mg, Magnesium_mg, Vitamin_A_IU_IU, Vitamin_A_RAE_mcg, Vitamin_C_mg, Vitamin_B_12_mcg, Vitamin_D_mcg, Vitamin_E_Alpha_Tocopherol_mg, Added_Sugar_g, Net_Carbs_g, Water_g, Omega_3s_mg, Omega_6s_mg, PRAL_score, Trans_Fatty_Acids_g, Soluble_Fiber_g, Insoluble_Fiber_g, Sucrose_g, Glucose_Dextrose_g, Fructose_g, Lactose_g, Maltose_g, Galactose_g, Starch_g, Total_sugar_alcohols_g, Phosphorus_P_mg, Sodium_mg, Zinc_Zn_mg, Copper_Cu_mg, Manganese_mg, Selenium_Se_mcg, Fluoride_F_mcg, Molybdenum_mcg, Chlorine_mg, Thiamin_B1_mg, Riboflavin_B2_mg, Niacin_B3_mg, Pantothenic_acid_B5_mg, Vitamin_B6_mg, Biotin_B7_mcg, Folate_B9_mcg, Folic_acid_mcg, Food_Folate_mcg, Folate_DFE_mcg, Choline_mg, Betaine_mg, Retinol_mcg, Carotene_beta_mcg, Carotene_alpha_mcg, Lycopene_mcg, Lutein_Zeaxanthin_mcg, Vitamin_D2_ergocalciferol_mcg, Vitamin_D3_cholecalciferol_mcg, Vitamin_D_IU_IU, Vitamin_K_mcg, Dihydrophylloquinone_mcg, Menaquinone_4_mcg, Fatty_acids_total_monounsaturated_mg, Fatty_acids_total_polyunsaturated_mg, Column_18_3_n_3_c_c_c_ALA_mg, Column_20_5_n_3_EPA_mg, Column_22_5_n_3_DPA_mg, Column_22_6_n_3_DHA_mg, Tryptophan_mg, Threonine_mg, Isoleucine_mg, Leucine_mg, Lysine_mg, Methionine_mg, Cystine_mg, Phenylalanine_mg, Tyrosine_mg, Valine_mg, Arginine_mg, Histidine_mg, Alanine_mg, Aspartic_acid_mg, Glutamic_acid_mg, Glycine_mg, Proline_mg, Serine_mg, Hydroxyproline_mg, Alcohol_g, Caffeine_mg, Theobromine_mg FROM grocery";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}
mysqli_close($conn);
echo json_encode($data);
?>


