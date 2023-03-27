<?php include 'header.php' ?>
<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <tr>
                            <th>Comments</th>
                            <th>Created</th>
                            <th>Writer</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Comments</th>
                            <th>Created</th>
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
<script>
    const deleteComment = (d) => {
        var id = JSON.parse(d)
        console.log('id', id)
        var msg = prompt("Are you sure you want to delete this post", "Yes")
        if (msg) {
            $.post("./actions/comments.php?id=" + id, function(data, status) {
                // 
                console.log('data', data)
                var jdata = JSON.parse(data)
                console.log('data', jdata)
                if (jdata['status'] == 200) {
                    $(".alert").html(jdata['message'])
                    alert(jdata['message'])
                    var str = jdata['status']['message']
                    $("tbody").html(str)

                } else {
                    // $(".alert").html(jdata['message'])
                }

            });
        }
    }
    $("document").ready(() => {
        $.get("./actions/comments.php", function(data, status) {
            // 
            // console.log('data', data)
            var jdata = JSON.parse(data)
            console.log('data', jdata['data'][0][0])
            if (jdata['status'] == 200) {
                // $(".alert").html(jdata['message'])
                var str = []
                for (let index = 0; index < jdata['data'].length; index++) {
                    str += " <tr> <td>" + jdata['data'][index][1] + "</td> <td>" +
                        jdata['data'][index][2] + " </td> <td> " + jdata['data'][index][4] + "</td><td>   <button onclick='deleteComment(" + JSON.stringify(jdata['data'][index][0]) + ")'  id=" + jdata['data'][index][0] + " class='btn btn-danger'>Delete</button> </td></tr> "

                }
                // console.log('str', str)
                $("tbody").html(str)




            } else {
                // $(".alert").html(jdata['message'])
            }

        });
    })
</script>

<?php include 'footer.php' ?>