<?php include 'header.php' ?>
<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
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
    $("document").ready(() => {
        $.get("./actions/users.php", function(data, status) {
            // 
            // console.log('data', data)
            var jdata = JSON.parse(data)
            // console.log('data', jdata)
            if (jdata['status'] == 200) {
                // $(".alert").html(jdata['message'])
                var str = []
                for (let index = 0; index < jdata['data'].length; index++) {
                    str += " <tr> <td>" + jdata['data'][index][3] + "</td> <td>" +
                        jdata['data'][index][4] + " </td> <td> " + jdata['data'][index][1] + "</td><td> <button id=" + jdata['data'][index][0] + " class='btn btn-danger'>Delete</button> </td></tr> "

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