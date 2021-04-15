<?php
session_start();
$sunucu_adi = "localhost";
$kullanici_adi= "root";
$sifre = "";
$veri_tabani = "crudsql2";
$baglanti = new mysqli($sunucu_adi, $kullanici_adi, $sifre, $veri_tabani);
mysqli_set_charset($baglanti,"utf8");
if ($baglanti->connect_error)
	die("Bağlantı sağlanamadı".$baglanti->connect_error);
if($_POST)
{
	$eposta=$_POST["bc_eposta"];
	$sifre=$_POST["bc_sifre"];			
	$sql= "select * from kullanici where eposta='$eposta' and sifre='$sifre'";
	$getir=$baglanti->query($sql);		
	if($getir->num_rows>0)		{
		while($row=$getir->fetch_assoc())		
		{
			$_SESSION["eposta"]=$row["eposta"];
			$_SESSION["sifre"]=$row["sifre"];			
			header("location:crud2.php");				
		}
	}
	else
	{			
		echo "<script type='text/javascript'>alert('E-Posta ya da şifrenizi yanlış girdiniz..');</script>";
	}
		
}

  ?>
<!doctype html>
<html lang="en">
	<head>	
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">		
		<title>CRUD</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">		
	</head>
	<body class="text-center">					
		<h1><br><h2 class="h3 mb-3 font-weight-normal">Lütfen Giriş Yapınız</h2></br></h1>
		<div class="container">
			<div class="row">
				<div class="col-md-12">			
					<form action="" method="POST">
						<div class="form-group row">
							<label for="eposta" class="col-sm-2 col-form-label">&nbsp;&nbsp;E-Posta :</label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="eposta" name="bc_eposta" placeholder="E-Posta adresinizi giriniz.." style="font-style:italic" required autofocus>
							</div>
						</div>
						<div class="form-group row">
							<label for="sifre" class="col-sm-2 col-form-label">&nbsp;&nbsp;Şifre :</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="sifre" name="bc_sifre" placeholder="Şifrenizi giriniz.." style="font-style:italic" required>
							</div>
						</div>						
						<div class="form-group row">
							<label for="eposta" class="col-sm-2 col-form-label"></label>		
							<div class="col-sm-2">	
								<button type="submit" class="btn btn-primary" value="sql" name="bc_sql">Giriş</button>						
								<button type="reset" class="btn btn-dark" value="temizle" name="bc_temizle">Temizle</button><br></br>				
							</div>
						</div>
					</form>
				</div>				
			</div>			
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	</body>
</html>