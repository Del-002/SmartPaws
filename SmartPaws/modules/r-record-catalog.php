<?php
    echo '
    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
        <div class="card mr-1 ml-1 border-left-warning shadow h-100 py-2">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <p class="card-text text-dark mb-2">Pet Name: <strong>';
                        echo $row['Pet_Name'];
                        echo '</strong></p><p class="card-text text-dark mb-2">Type: <strong>';
                        echo $row['Type'];
                        echo '</strong></p><p class="card-text text-dark mb-2">Breed: <strong>';
                        echo $row['Breed'];
                        echo '</strong></p><p class="card-text text-dark mb-3">Owner: <strong>';
                        echo $row['Owner_Name'];
                        echo '</strong></p>
                    <div class="card text-center">
                        <a href="R_Pet_Record.php?pet-ID='.$row['Pet_ID'].'&owner-ID='.$row['Owner_ID'].'"class="btn btn-warning mb-1">View Record</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';