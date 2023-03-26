<?php
include 'header.php';

?>
<div>
    <?php
    require "../db.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Set image placement folder
        $target_dir = "./media/";
        //File name
        $filename = basename($_FILES["file"]["name"]);
        // Get file path
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        // Get file extension
        $imageExt = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Allowed file types
        $allowd_file_ext = array("jpg", "jpeg", "png", "mp4", "webp");
        $title = $_POST['title'];
        $category = $_POST['category'];
        $content = $_POST['content'];


        // print_r($_FILES['file']);
        if (!file_exists($_FILES["file"]["tmp_name"])) {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "Select image to upload."
            );
        } else if (!in_array($imageExt, $allowd_file_ext)) {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "Allowed file formats .jpg, .jpeg, .mp4 and .png."
            );
        } else if ($_FILES["file"]["size"] > 5097152) {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "File is too large. File size should be less than 2 megabytes."
            );
        } else if (file_exists($target_file)) {
            $resMessage = array(
                "status" => "alert-danger",
                "message" => "File already exists."
            );
        } else {
            // echo 'here';
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $name = $_SESSION['fullname'];
                $id = $_SESSION['id'];

                $sql_query = "INSERT INTO posts (`title`,`content`,`tag`,`category`,`writerid`,`fullname`,`file`) VALUES ('$title','$content','','$category','$id',' $name','$filename')";
                // execute the SQL query
                $result = $conn->query($sql_query);

                $conn->commit();
                if ($result) {
                    echo "Post created";
                    $resMessage = array(
                        "status" => "alert-success",
                        "message" => "Image uploaded successfully."
                    );
                }
            } else {
                $resMessage = array(
                    "status" => "alert-danger",
                    "message" => "Image coudn't be uploaded."
                );
            }
        }
        // print_r($resMessage);
    }
    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="formFileLg" class="form-label">Image/Video</label>
                        <input class="form-control form-control-lg" name="file" id="formFileLg" type="file">
                    </div>
                    <div class="form-group">
                        <label for="formFileLg" class="form-label">Title</label>
                        <input class="form-control form-control-lg" name="title" id="formFileLg" type="text">
                    </div>
                    <div class="form-group">
                        <label for="exampleDataList" class="form-label">Content</label>
                        <textarea type="text" name="content" class="content form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                        </textarea>
                    </div>
                    <!-- <div class="form-group"> -->
                    <label for="exampleDataList" class="form-label">Category</label>
                    <input name="category" class="category form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                    <datalist id="datalistOptions">
                        <option selected>select category</option>
                        <option value="night">Night Life</option>
                        <option value="food">Food & Events</option>
                        <option value="arts">Arts & Culture</option>
                        <option value="adventure">Adventure & Sport</option>
                    </datalist>
                    <!-- </div> -->




                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <input class="form-control  btn btn-primary" type="submit" name="Post" value="Post" />
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // $("document").ready(() => {
    //     $.get("./actions/comments.php", function(data, status) {
    //         // 
    //         // console.log('data', data)
    //         var jdata = JSON.parse(data)
    //         console.log('data', jdata)
    //         if (jdata['status'] == 200) {
    //             // $(".alert").html(jdata['message'])
    //             var str = []
    //             for (let index = 0; index < jdata['data'].length; index++) {
    //                 str += " <tr> <td>" + jdata['data'][index][1] + "</td> <td>" +
    //                     jdata['data'][index][2] + " </td> <td> " + jdata['data'][index][4] + "</td><td> <button id=" + jdata['data'][index][0] + " class='btn btn-danger'>Delete</button> </td></tr> "

    //             }
    //             // console.log('str', str)
    //             $("tbody").html(str)

    // } else {
    //     // $(".alert").html(jdata['message'])
    // }

    // });
    // })
</script>

<?php include 'footer.php' ?>