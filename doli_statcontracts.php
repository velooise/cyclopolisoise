<?php

$apiKey='656HetcjKd2EUoAP1P6mRy7lBLu17n5R';
$apiUrl="https://admin.au5v.fr/api/index.php/";

echo "starting stats\n";


function SendMsg($subject,$text) {
	
	
	$to      = 'relaisvelo@au5v.fr';
    $headers = 'From: robot@au5v.fr'       . "\r\n" .
                 'Reply-To: webmaster@au5v.fr' . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $text, $headers);
}
function CallAPI($method, $apikey, $url, $data = false)
{
	

    $curl = curl_init();

    $httpheader = ['DOLAPIKEY: '.$apikey];

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            $httpheader[] = "Content-Type:application/json";

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            break;
        case "PUT":

	    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
            $httpheader[] = "Content-Type:application/json";

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
	//    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	//    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $httpheader);

    $result = curl_exec($curl);
	if(curl_errno($curl))
	{
    	echo 'Erreur Curl : ' . curl_error($curl);
	}
 
    curl_close($curl);

    return $result;
}
#main
$annee = date("Y");
$mois = date("m") -1;
if ($mois < 1) { 
	$mois=12;
	$annee = $annee - 1;
}

echo "connecting DB\n";
$mysqli = new mysqli('localhost:3306', 'au5vadmin_exploitdoli', '24j[Uq\FD;p!9PdG?', 'au5vadmin_dol651');
if (!$mysqli) {
   die('Could not connect: ' . $mysqli->Error);
} else {
	printf("Success... %s\n", $mysqli->host_info);
}
$stat = "Statistiques mensuelles AXO-Velo pour $mois/$annee\n";
# mis a dispo
$sql= "select count(c.ref) from  llxqj_contrat as c,  llxqj_contratdet as cd, llxqj_product as p where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and cd.date_cloture is null and p.ref = 'AXOLOCCOL';";

$result = $mysqli->query($sql);
 echo "1 Returned rows are: " . $result -> num_rows . "\n";
$l=$result -> fetch_array(MYSQLI_NUM);
$stat.= $l[0] . " velos mis a dispo (AXOLOCCOL)\n";
# **Vélos en location**
$sql="select count(c.ref) from  llxqj_contrat as c,  llxqj_contratdet as cd, llxqj_product as p where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and cd.date_cloture is null and p.ref like 'AXOLOC%M'; ";
$result = $mysqli->query($sql);
 echo "2 Returned rows are: " . $result -> num_rows . "\n";

$l=$result -> fetch_array(MYSQLI_NUM);
$stat.= $l[0] . " velos en location\n";



#nouveaux contrats du mois
$sql="select count(*) from  llxqj_contrat as c,  llxqj_contratdet as cd, llxqj_product as p where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and cd.date_cloture is null  and MONTH(cd.date_ouverture) = $mois and YEAR(cd.date_ouverture) = $annee  and p.ref like 'AXOLOC%M' and fk_soc not in (
select fk_soc from llxqj_contrat as c, llxqj_contratdet as cd, llxqj_product as p where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and p.ref like 'AXOLOC%M' and MONTH(cd.date_cloture) >= ($mois -1) and YEAR(cd.date_cloture) = $annee);";
$result = $mysqli->query($sql);
 echo "4 Returned rows are: " . $result -> num_rows . "\n";

$l=$result -> fetch_array(MYSQLI_NUM);
$stat.= $l[0] . " nouveaux contrats ce mois\n";

# retours de velos
$sql="select count(*) from  llxqj_contrat as c,  llxqj_contratdet as cd, llxqj_product as p where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and cd.date_cloture is NOT null  and MONTH(cd.date_cloture) = $mois and YEAR(cd.date_cloture) = $annee  and p.ref like 'AXOLOC%M' and fk_soc  not in (
select c.fk_soc from  llxqj_contrat as c,  llxqj_contratdet as cd, llxqj_product as p where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and cd.date_cloture is null and p.ref like 'AXOLOC%M'); ";
$result = $mysqli->query($sql);
 echo "5 Returned rows are: " . $result -> num_rows . "\n";

$l=$result -> fetch_array(MYSQLI_NUM);

$stat.= $l[0] . " retours de velos\n";

# Renouvellements
$sql="select count(*) from  llxqj_contrat as c,  llxqj_contratdet as cd, llxqj_product as p where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and cd.date_cloture is null  and MONTH(cd.date_ouverture) = $mois and YEAR(cd.date_ouverture) = $annee  and p.ref like 'AXOLOC%M' and fk_soc  in (
select fk_soc from llxqj_contrat as c, llxqj_contratdet as cd, llxqj_product as p where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and p.ref like 'AXOLOC%M' and MONTH(cd.date_cloture) >= ($mois -1) and YEAR(cd.date_cloture) = $annee);";
$result = $mysqli->query($sql);
 echo "6 Returned rows are: " . $result -> num_rows . "\n";

$l=$result -> fetch_array(MYSQLI_NUM);
$stat.= $l[0] . " renouvellements de contrats\n";

# stats par contrat
$sql="select p.ref, count(*) from  llxqj_contrat as c,  llxqj_contratdet as cd, llxqj_product as p where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and cd.date_cloture is null and p.ref like 'AXOLOC%' group by p.ref order by p.ref;";
$result = $mysqli->query($sql);
 echo "7 Returned rows are: " . $result -> num_rows . "\n";

$stat.= "Statistiques par contrat\n";
while ($l=$result -> fetch_array(MYSQLI_NUM)) {
   $stat.= $l[0] . " " . $l[1] . "\n" ;
}

# Stats contrats expirés
$sql="select count(*) from  llxqj_contrat as c,  llxqj_contratdet as cd, llxqj_product as p, llxqj_societe as s where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and s.rowid = c.fk_soc and cd.date_fin_validite < now() and cd.date_cloture is null;";
$result = $mysqli->query($sql);
 echo "8 Returned rows are: " . $result -> num_rows . "\n";

$l=$result -> fetch_array(MYSQLI_NUM);
$stat.= $l[0] . " contrats expires\n";

# Stats contrats expirés > 1 mois
$sql="select count(*) from  llxqj_contrat as c,  llxqj_contratdet as cd, llxqj_product as p, llxqj_societe as s where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and s.rowid = c.fk_soc and cd.date_fin_validite < now() and cd.date_cloture is null and datediff(now(),cd.date_fin_validite) > 30; ";
$result = $mysqli->query($sql);
 echo "9 Returned rows are: " . $result -> num_rows . "\n";

$l=$result -> fetch_array(MYSQLI_NUM);
$stat.= $l[0] . " contrats expires plus de un mois\n";

# CA des contractants
$sql="select f.ref,datef, f.total_ttc, p.ref, p.label,  d.total_ttc from llxqj_facture f, llxqj_facturedet d, llxqj_product p where d.fk_facture = f.rowid and d.fk_product = p. rowid and month(f.datef) = $mois and YEAR(f.datef) = $annee and fk_soc in (select fk_soc from llxqj_contrat as c, llxqj_contratdet as cd, llxqj_product as p where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and cd.date_cloture is NOT null and MONTH(cd.date_cloture) = $mois and YEAR(cd.date_cloture) = $annee and p.ref like 'AXOLOC%M' UNION select fk_soc from llxqj_contrat as c, llxqj_contratdet as cd, llxqj_product as p where c.rowid = cd.fk_contrat and p.rowid = cd.fk_product and cd.date_cloture is null and p.ref like 'AXOLOC%M');";

$result = $mysqli->query($sql);
 echo "10 Returned rows are: " . $result -> num_rows . "\n";
$total=0;
$stat.="CA des abonnes\n";
while ($l=$result -> fetch_array(MYSQLI_NUM)) {
   $stat.= $l[0] . "; " . $l[1] . "; " . $l[2] . "; " . $l[3] . "; " . $l[4]  . "; " . $l[5] . "\n" ;
	$total+=$l[5];
}
	$stat.= $l[0] . "Total CA des abonnes : $total E\n";

echo "Envoi des stats\n";
	
	SendMsg("Statistiques AXO velo pour le mois $mois",$stat);
	



?>

