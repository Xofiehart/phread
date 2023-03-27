<?php include 'header.php' ?>
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
    $allowd_file_ext = array("jpg", "jpeg", "png", "mp4");
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $postid = $_POST['postid'];



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
    } else if ($_FILES["file"]["size"] > 2097152) {
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
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            $name = $_SESSION['fullname'];
            $id = $_SESSION['id'];

            $sql_query = "INSERT INTO posts (`title`,`content`,`tag`,`category`,`writerid`,`fullname`,`file`) VALUES ('$title','$content','','$category','$id',' $name','$filename') where id='$postid'";
            // execute the SQL query
            $result = $conn->query($sql_query);

            $conn->commit();
            if ($result) {
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
}
?>
<div>
    <div class="card shadow mb-4 mt--10" id="card">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Writer</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Writer</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>



                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<div class="card shadow mb-4" id="card2">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
    </div>
    <div class="card-body">
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="formFileLg" class="form-label">Image/Video</label>
                <input class="form-control form-control-lg" name="file" id="formFileLg" type="file">
            </div>
            <div class="form-group">
                <label for="formFileLg" class="form-label">Title</label>
                <input class="title form-control form-control-lg" name="title" id="formFileLg" type="text">
            </div>
            <div class="form-group">
                <input hidden class="postid form-control form-control-lg" name="postid" id="formFileLg" type="text">
            </div>
            <div class="form-group">
                <label for="exampleDataList" class="form-label">Content</label>
                <textarea type="text" name="content" class="content form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                        </textarea>
            </div>
            <!-- <div class="form-group"> -->
            <label for="exampleDataList" class="form-label">Category</label>
            <input name="category" class=" category form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
            <datalist id="datalistOptions">
                <option selected>select category</option>
                <option value="=night">Night Life</option>
                <option value="food">Food & Events</option>
                <option value="Arts">Arts & Culture</option>
                <option value="adventure">Adventure & Sport</option>
            </datalist>
            <!-- </div> -->
            <div class="form-group row pt-5">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input class="form-control  btn btn-primary" type="submit" name="Post" value="Post" />
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    const edit = (data) => {
        $("#card").css("display", "none");
        $("#card2").css("display", "block");
        console.log('dataaaa', data[0][0])
        $('.title').val(data[0][1])
        $('.content').val(data[0][2])
        $('.category').val(data[0][3])
        $('.postid').val(data[0][0])
    }
    const deletePost = (d) => {
        var id = JSON.parse(d)
        console.log('id', id)
        var msg = prompt("Are you sure you want to delete this post", "Yes")
        if (msg) {
            $.post("./actions/deletePost.php?id=" + id, function(data, status) {
                // 
                console.log('data', data)
                var jdata = JSON.parse(data)
                console.log('data', jdata)
                if (jdata['status'] == 200) {
                    $(".alert").html(jdata['message'])
                    window.location.reload()
                    var str = jdata['status']['message']
                    $("tbody").html(str)

                } else {
                    // $(".alert").html(jdata['message'])
                }

            });
        }
    }
    $("document").ready(() => {
        $("#card2").css("display", "none");
        $("#card").css("display", "block");
        var {
            id
        } = JSON.parse(localStorage.getItem("user"))
        console.log('id', id)
        $.get("./actions/writerPost.php?id=" + id, function(data, status) {
            // 
            console.log('data', data)
            var jdata = JSON.parse(data)
            // console.log('data', jdata['data'][0][0])
            if (jdata['status'] == 200) {
                // $(".alert").html(jdata['message'])
                var str = []
                for (let index = 0; index < jdata['data'].length; index++) {
                    str += " <tr> <td>" + jdata['data'][index][1] + "</td> <td>" +
                        jdata['data'][index][3] + " </td> <td> " + jdata['data'][index][4] + "</td><td> <button  onclick='deletePost(" + JSON.stringify(jdata['data'][index][0]) + ")'  class='btn btn-danger'>Delete</button>   <button onclick='edit(" + JSON.stringify(jdata['data']) + ")'  class='btn btn-info'>Edit</button></td > < /tr> "

                }
                // console.log('str', str)
                $("tbody").html(str)


                // const myModal = document.getElementById('pmodal')
                // const myInput = document.getElementById('myInput')

                // myModal.addEventListener('shown.bs.modal', () => {
                //     myInput.focus()
                // })

            } else {
                // $(".alert").html(jdata['message'])
            }

        });
    })
</script>

<?php include 'footer.php' ?>