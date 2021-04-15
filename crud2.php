<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<title>CRUD</title>
	</head>
	<body>
		<?php
		$sunucu_adi = "localhost";
		$kullanici_adi= "root";
		$sifre = "";
		$veri_tabani = "crudsql2";
		$baglanti = new mysqli($sunucu_adi, $kullanici_adi, $sifre, $veri_tabani);
		mysqli_set_charset($baglanti,"utf8");
		if ($baglanti->connect_error)
			die("Bağlantı sağlanamadı".$baglanti->connect_error);
		?>
		<?php
		if(isset($_POST["bc_kaydet"]))
		{
			$sql = "INSERT INTO	`urun`	(`id`, `urun_adi`, `adet`, `fiyat`)	
			VALUES 	(NULL, '".$_POST['bc_urun_adi']."', '".$_POST['bc_adet']."', '".$_POST['bc_fiyat']."')";
			$baglanti->query($sql);
		}
		else if(isset($_POST["bc_guncelle"]))
		{
			$sql= "UPDATE `urun` SET `urun_adi` = '".$_POST['bc_urun_adi']."', `adet` = '".$_POST['bc_adet']."', `fiyat` = '".$_POST['bc_fiyat']."' WHERE `urun`.`id` = ".$_POST['bc_kayit_no'].";";		
			$baglanti->query($sql);
		}
		else if(isset($_POST["bc_sil"]))
		{
			$sql= "DELETE FROM `urun` WHERE `urun`.`id` = ".$_POST['bc_kayit_no'];
			$baglanti->query($sql);			
		}
		else if(isset($_POST["bc_duzenle"]))
		{
			$sql= "SELECT * FROM `urun` WHERE `id` = ".$_POST['bc_kayit_no'];
			$sonuc=$baglanti->query($sql);	
			$kayit=$sonuc->fetch_assoc();
		}
		?>
		<h1><br></br></h1>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php
					if(!isset($_POST["bc_duzenle"]))
					{
					?>
					<form action="" method="POST">
						<div class="form-group row">
							<label for="urun_adi" class="col-sm-2 col-form-label">&nbsp;&nbsp;Ürün Adı :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="urun_adi" name="bc_urun_adi" placeholder="Ürün adını giriniz.." style="font-style:italic" autofocus required>
							</div>
						</div>
						<div class="form-group row">
							<label for="adet" class="col-sm-2 col-form-label">&nbsp;&nbsp;Adet :</label>
							<div class="col-sm-10">
								<input type="text" pattern="\d*" class="form-control" id="adet" name="bc_adet" placeholder="Adedi giriniz.." style="font-style:italic" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="fiyat" class="col-sm-2 col-form-label">&nbsp;&nbsp;Fiyat :</label>
							<div class="col-sm-10">
								<input type="text" pattern="\d*" class="form-control" id="fiyat" name="bc_fiyat" placeholder="Fiyatı giriniz.." style="font-style:italic" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="fiyat" class="col-sm-2 col-form-label"></label>	
							<div class="col-sm-10">	
								<button type="submit" class="btn btn-primary" value="kaydet" name="bc_kaydet">Kaydet</button>						
								<button type="reset" class="btn btn-dark" value="temizle" name="bc_temizle">Temizle</button><br></br>						
							</div>
						</div>
					</form>
					<?php
					}
					else
					{
					?>			
					<form action="" method="POST">
						<div class="form-group row">
							<label for="urun_adi" class="col-sm-2 col-form-label">&nbsp;&nbsp;Ürün Adı :</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="urun_adi" name="bc_urun_adi" value="<?=$kayit["urun_adi"]?>" autofocus required>
							</div>
						</div>
						<div class="form-group row">
							<label for="adet" class="col-sm-2 col-form-label">&nbsp;&nbsp;Adet :</label>
							<div class="col-sm-10">
								<input type="text" pattern="\d*" class="form-control" id="adet" name="bc_adet" required value="<?=$kayit["adet"]?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="fiyat" class="col-sm-2 col-form-label">&nbsp;&nbsp;Fiyat :</label>
							<div class="col-sm-10">
								<input type="text" pattern="\d*" class="form-control" id="fiyat" name="bc_fiyat" required value="<?=$kayit["fiyat"]?>" >
							</div>
						</div>
						<div class="form-group row">
							<label for="fiyat" class="col-sm-2 col-form-label"></label>	
							<div class="col-sm-10">	
								<input type="hidden" name="bc_kayit_no" value="<?=$kayit["id"]?>">
								<button type="submit" class="btn btn-warning" value="güncelle" name="bc_guncelle">Güncelle</button>	
								<button type="reset" class="btn btn-info" value="ilk_haline_don" name="bc_ilk_haline_don">İlk Haline Dön</button><br></br>		
							</div>
						</div>
					</form>
					<?php
					}
					?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped">
							<thead>
									<tr>
										<th scope="col">#<br /></th>
										<th scope="col"><u>Ürün Adı</u><br /></th>
										<th scope="col"><u>Adet</u><br /></th>
										<th scope="col"><u>Fiyat</u><br /></th>
									</tr>
							</thead>
							<tbody>
							<?php
							$sql="SELECT * FROM `urun`";
							$sonuc=$baglanti->query($sql);
							$i=0;
							while($kayit=$sonuc->fetch_assoc())
							{	
								$i++;
							?>
							<tr>
								<th scope="row"><?=$i."."?></th>
								<td><?=$kayit["urun_adi"]?></td>
								<td><?=$kayit["adet"]?></td>
								<td><?=$kayit["fiyat"]?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="bc_kayit_no" value="<?=$kayit["id"]?>">
										<button type="submit" class="btn btn-success" value="duzenle" name="bc_duzenle">Düzenle</button>
										<button type="submit" class="btn btn-danger" value="sil" name="bc_sil">Sil</button>
									</form>
								</td>
							</tr>
							<?php
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	</body>
</html>