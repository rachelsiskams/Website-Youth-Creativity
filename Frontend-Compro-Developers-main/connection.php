<?php
$url_db = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "dbartikel";

$conn = new mysqli( $url_db, $username_db, $password_db, $dbname);
if ($conn -> connect_error){
    die("". $conn -> connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){   
    $request = $_POST["request"];

    
    if($request === "readdbrm"){ //search
        $sql = "SELECT id, title ,img, sectiontop FROM table_rekomend";
        $result = $conn -> query($sql);
        $data = array(); 
        if($result -> num_rows > 0){     
            $response["status"] = "success";      
            while ($row = $result -> fetch_assoc()){
                $response["id"][] = $row["id"] ; 
                $response["title"][] = $row["title"] ;
                $response["img"][] = $row["img"] ; 
                $response["sectiontop"][] = $row["sectiontop"] ;
            };
            
        } else {
            $response["status"] = "gagal";
            $response["message"] = "Tidak ditemukan";
        }
        echo json_encode($response);
    }
    if($request === "readdbtr"){ //search
        $sql = "SELECT id, title ,img, sectiontop FROM table_trending";
        $result = $conn -> query($sql);
        $data = array(); 
        if($result -> num_rows > 0){     
            $response["status"] = "success";      
            while ($row = $result -> fetch_assoc()){
                $response["id"][] = $row["id"] ; 
                $response["title"][] = $row["title"] ;
                $response["img"][] = $row["img"] ; 
                $response["sectiontop"][] = $row["sectiontop"] ;
            };
            
        } else {
            $response["status"] = "gagal";
            $response["message"] = "Tidak ditemukan";
        }
        echo json_encode($response);
    }
    if($request === "readmorebyid"){ //search
        $id = $_POST["id"];
        $c = $_POST["c"];
        if ($c === "tr"){
            $sql = "SELECT id, title ,img, sectiontop, sectionbottom FROM table_trending WHERE id = $id";
            $result = $conn -> query($sql);
            $data = array(); 
            if($result -> num_rows > 0){     
                $response["status"] = "success";      
                while ($row = $result -> fetch_assoc()){
                    $response["id"][] = $row["id"] ; 
                    $response["title"][] = $row["title"] ;
                    $response["img"][] = $row["img"] ; 
                    $response["sectiontop"][] = $row["sectiontop"] ;
                    $response["sectionbottom"][] = $row["sectionbottom"] ;
                };
                
            } else {
                $response["status"] = "gagal";
                $response["message"] = "Tidak ditemukan";
            }
            echo json_encode($response);
        } else {
        $sql = "SELECT id, title ,img, sectiontop, sectionbottom FROM table_rekomend WHERE id = $id";
        $result = $conn -> query($sql);
        $data = array(); 
        if($result -> num_rows > 0){     
            $response["status"] = "success";      
            while ($row = $result -> fetch_assoc()){
                $response["id"][] = $row["id"] ; 
                $response["title"][] = $row["title"] ;
                $response["img"][] = $row["img"] ; 
                $response["sectiontop"][] = $row["sectiontop"] ;
                $response["sectionbottom"][] = $row["sectionbottom"] ;
            };
            
        } else {
            $response["status"] = "gagal";
            $response["message"] = "Tidak ditemukan";
        }
        echo json_encode($response);
    }
}
    if($request === "searchdbrm"){ //search
        $query = $_POST["query"];
        $sql = "SELECT id, title ,img, sectiontop FROM table_rekomend WHERE title LIKE '%$query%'";
        $result = $conn -> query($sql);
        $data = array(); 
        if($result -> num_rows > 0){     
            $response["status"] = "success";      
            while ($row = $result -> fetch_assoc()){
                $response["id"][] = $row["id"] ; 
                $response["title"][] = $row["title"] ;
                $response["img"][] = $row["img"] ; 
                $response["sectiontop"][] = $row["sectiontop"] ;
            };
            
        } else {
            $response["status"] = "gagal";
            $response["message"] = "Tidak ditemukan";
        }
        echo json_encode($response);
    }
    if($request === "searchdbtr"){ //search
        $query = $_POST["query"];
        $sql = "SELECT id, title ,img, sectiontop FROM table_trending WHERE title LIKE '%$query%'";
        $result = $conn -> query($sql);
        $data = array(); 
        if($result -> num_rows > 0){     
            $response["status"] = "success";      
            while ($row = $result -> fetch_assoc()){
                $response["id"][] = $row["id"] ; 
                $response["title"][] = $row["title"] ;
                $response["img"][] = $row["img"] ; 
                $response["sectiontop"][] = $row["sectiontop"] ;
            };
            
        } else {
            $response["status"] = "gagal";
            $response["message"] = "Tidak ditemukan";
        }
        echo json_encode($response);
    }
    if($request === "searchtittle"){ //search
        $query = $_POST["query"];
        $sql = "SELECT id, title FROM table_rekomend WHERE title LIKE '%$query%'";
        $result = $conn -> query($sql);
        $data = array(); 
        if($result -> num_rows > 0){     
            $response["status"] = "success";      
            while ($row = $result -> fetch_assoc()){
                $response["id"][] = $row["id"] ; 
                $response["title"][] = $row["title"] ;
                $response["category"][] = "rm" ; 
            };
        } else {
            $response["status"] = "gagal";
            $response["message"] = "Tidak ditemukan";
        }
        echo json_encode($response);
    }
    if ($request === "visited"){
        $sql = "SELECT SUM FROM visited WHERE ID = 'GUESS'";
        $result = $conn -> query($sql);
        if ( $result -> num_rows > 0){
            $row = $result -> fetch_assoc();
            $sum = $row["SUM"];
            $sumint = (int)$sum;
            $sumint += 1;
            $sql = "UPDATE `visited` SET `SUM` = '$sumint'";
            $conn -> query($sql);
            $response = "success '$sumint'";
        
        } else {
            $response = "gagal'$sumint'";
        }
        echo $response;
        }
        $conn -> close();
}

?>
