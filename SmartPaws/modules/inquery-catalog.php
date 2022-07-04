<?php
	echo '<div class="col-lg-6 col-md-12 mb-4">';
    	echo '<div class="card mr-1 ml-3 border-left-info">';
        	echo '<div class="card-body">';
            	echo '<h5 class="card-title">Query:</h5>';
                	echo '<div class="row mb-3">';
                    	echo '<div class="col-md-12">';
                        	echo '<p class="card-text">';

                        	if(str_word_count($card['Concerns']) > 15){
								echo implode(" ", array_slice(explode(" ", $card['Concerns']), 0,15)) . '...';
							}else{
								echo $card['Concerns'];
							}

                        	echo '</p>';
						echo '</div>';
					echo '</div>';
					//image or videos
					if($card['Img_Url'] == "" && $card['Vid_Url'] ==""){
						echo '<div class="row mb-2">';
							echo '<div class="col-md-2">';
								echo '<img class="img-fluid" src="../img/pos.jpg">';
							echo '</div>';

							echo '<div class="col-md-8 text-center mt-5 mb-5">';
								echo '<h4><strong>No Files was uploaded</strong></h4>';
							echo '</div>';

							echo '<div class="col-md-2">';
							echo '</div>';
						echo '</div>';	
					}elseif($card['Img_Url'] != "" && $card['Vid_Url'] ==""){
						echo '<div class="row mb-2">';
							echo '<div class="col-md-4">';
							echo '</div>';

							echo '<div class="col-md-4">';
								echo '<img class="img-fluid" onclick="img_modal(this.src)" src="../uploads/images/' . $card['Img_Url'] . '" data-toggle="modal" data-target="#imgModal">';
							echo '</div>';

							echo '<div class="col-md-4">';
							echo '</div>';
						echo '</div>';
					}elseif($card['Img_Url'] == "" && $card['Vid_Url'] !=""){
						echo '<div class="row mb-2">';
							echo '<div class="col-md-4">';
								echo '<img class="img-fluid" src="../img/pos.jpg">';
							echo '</div>';

							echo '<div class="col-md-4">';
								echo '<button class="btn btn-secondary" style="width: 100%; height: 100%;"type="button" onclick="vid_modal('. $card['ID'] .')">';
									echo '<i class="fa fa-play-circle" style="font-size: 50px;"></i>';
								echo '</button>';
							echo '</div>';

							echo '<div class="col-md-4 ">';
							echo '</div>';
						echo '</div>';
					}else{
						echo '<div class="row mb-2">';
							echo '<div class="col-md-2">';
							echo '</div>';

							echo '<div class="col-md-4">';
								echo '<img class="img-fluid" onclick="img_modal(this.src)" src="../uploads/images/' . $card['Img_Url'] . '" data-toggle="modal" data-target="#imgModal">';
							echo '</div>';

							echo '<div class="col-md-4">';
								echo '<button class="btn btn-secondary" style="width: 100%; height: 100%;"type="button" onclick="vid_modal('. $card['ID'] .')">';
									echo '<i class="fa fa-play-circle" style="font-size: 50px;"></i>';
								echo '</button>';
							echo '</div>';

							echo '<div class="col-md-2">';
							echo '</div>';
						echo '</div>';
					}
					echo '<div class="row">';
						echo '<div class="col-lg-6">';
							echo '<p class="card-text">From: ' . $card['Owner_Name'] . '</p>';
						echo '</div>';

						echo '<div class="col-lg-6 align-self-end">';
							echo '<p class="card-text" align="right">';
								echo '<a href="Answer.php?econ=' . $card['ID'] . '" class="btn btn-success">Answer</a>';
							echo '</p>';
						echo '</div>';
					echo '</div>';

			echo '</div>';

		echo '</div>';
	echo '</div>';
?>