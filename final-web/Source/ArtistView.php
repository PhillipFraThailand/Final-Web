<?php
    require_once('Database/ArtistService.php');
    $dp = new ArtistService();
    $results = $dp->fetchArtists();
?>

<!-- Table header -->
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
<!-- IF LOGGED IN AS ADMIN SHOW EXTRA OPTIONS -->
<!-- IF LOGGED IN AS ADMIN SHOW EXTRA OPTIONS -->
    <tbody>
        <?php foreach ($results as $row) { 
                echo "<tr>
                <td>" . $row[0] . "</td>
                </tr>"; 
            }
        ?>
    </tbody>
</table>

<?php
    if(isset($_GET['page']) && $_GET['page'] >= 1) {
        $nextPage = (int)$_GET['page'] + 1;
        $prevPage = $nextPage - 2;
        $currentPage = $_GET['page'];
        echo '<form method="GET" action="">';
        echo "Previous: <input type='submit' name='page' value='$prevPage'>";
        echo "&nbsp; Current: <b> $currentPage </b> &nbsp;";
        echo "Next: <input type='submit' name='page' value='$nextPage'>";
        echo '</form>';
    } else {
        $_GET['page'] = 1;
        $currentPage = $_GET['page'];
        echo '<form method="GET" action="">';
        echo "<input type='submit' name='page' value='$currentPage'>";
        echo '</form>';  
    }
?>

