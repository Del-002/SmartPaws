<?php
	$ID = $row['Owner_ID'];
	$Pet = $row['Pet_ID'];
	echo '<div class="col-lg-6 col-md-12 mb-3">';
		echo '<div class="card mr-2 ml-2 border-left-info shadow h-100 py-2">';
			echo '<div class="card-body">';
			$tbl = $pdo->query("SELECT Pet_Name, Owner_Name FROM owner_profile AS O JOIN pet_info_tbl AS P ON O.Owner_ID = P.Owner_ID WHERE O.Owner_ID = '$ID' AND P.Pet_ID = '$Pet'");
			$ans = $tbl->fetch();
				echo '<h6 class="card-title text-dark">Owner Name: <strong>'.$ans['Owner_Name'].'</strong> | Pet Name: <strong>'.$ans['Pet_Name'].'</strong></h6>';

				echo '<div class="row no-gutter mb-3">';
					echo '<div class="col-md-12">';
						echo '<p class="card-text text-dark mt-2">';
							if(str_word_count($row['Concerns']) > 15){
								echo implode(" ", array_slice(explode(" ", $row['Concerns']), 0,15)) . '...';
							}else{
								echo $row['Concerns'];
							}
                        echo '</p>';
					echo '</div>';
				echo '</div>';

				echo '<div class="card-text text-center">';
						if($row['Img_Url'] == "" && $row['Vid_Url'] == ""){
							echo '<div class="row justify-content-center mb-3 ">';
								echo '<div class="col-md-2">';
									echo '<img class="img-fluid" src="../img/pos.jpg">';
								echo '</div>';

								echo '<div class="col-md-8 align-self-center mt-5">';
									echo '<h4><strong>No files was uploaded</strong></h4>';
								echo '</div>';

								echo '<div class="col-md-2">';
								echo '</div>';
							echo '</div>';

							echo '<div class="row justify-content-center mt-5 ">';
								echo '<a href="Answer.php?econ='.$row['ID'].'"class="btn btn-success">Answer</a>';
							echo '</div>';
						}elseif($row['Img_Url'] != "" && $row['Vid_Url'] == ""){
							echo '<div class="row justify-content-center mb-3">';
								echo '<div class="col-md-4">';
								echo '</div>';

								echo '<div class="col-md-4">';
									echo '<img class="img-fluid" onclick="img_modal(this.src)" src="../uploads/images/' . $row['Img_Url'] . '" data-toggle="modal" data-target="#imgModal">';
								echo '</div>';

								echo '<div class="col-md-4">';
								echo '</div>';
							echo '</div>';

							echo '<div class="row justify-content-center mt-3">';
								echo '<a href="Answer.php?econ='.$row['ID'].'"class="btn btn-success">Answer</a>';
							echo '</div>';
						}elseif($row['Img_Url'] == "" && $row['Vid_Url'] != ""){
							echo '<div class="row justify-content-center mb-3">';
								echo '<div class="col-md-4">';
									echo '<img class="img-fluid" src="../img/pos.jpg">';
								echo '</div>';

								echo '<div class="col-md-4">';
									echo '<button class="btn btn-secondary" style="width: 100%; height: 100%;"type="button" onclick="vid_modal('. $row['ID'] .')">';
										echo '<i class="fa fa-play-circle" style="font-size: 50px;"></i>';
									echo '</button>';
								echo '</div>';

								echo '<div class="col-md-4">';
								echo '</div>';
							echo '</div>';

							echo '<div class="row justify-content-center mt-3">';
								echo '<a href="Answer.php?econ='.$row['ID'].'"class="btn btn-success">Answer</a>';
							echo '</div>';
						}else{
							echo '<div class="row justify-content-center mb-3">';
								echo '<div class="col-md-2">';
								echo '</div>';

								echo '<div class="col-md-4">';
									echo '<img class="img-fluid" onclick="img_modal(this.src)" src="../uploads/images/' . $row['Img_Url'] . '" data-toggle="modal" data-target="#imgModal">';
								echo '</div>';

								echo '<div class="col-md-4">';
									echo '<button class="btn btn-secondary" style="width: 100%; height: 100%;"type="button" onclick="vid_modal('. $row['ID'] .')">';
										echo '<i class="fa fa-play-circle" style="font-size: 50px;"></i>';
									echo '</button>';
								echo '</div>';

								echo '<div class="col-md-2">';
								echo '</div>';
							echo '</div>';

							echo '<div class="row justify-content-center mt-3">';
								echo '<a href="Answer.php?econ='.$row['ID'].'"class="btn btn-success">Answer</a>';
							echo '</div>';
						}

				echo '</div>';

			echo '</div>';
	
		echo '</div>';
	echo '</div>';
?>