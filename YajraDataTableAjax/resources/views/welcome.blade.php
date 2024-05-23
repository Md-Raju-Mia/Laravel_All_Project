@include('head')
@include('add_user_modal')
@include('update_user_modal')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
                <h2 class="text-center my-4">Laravel 10 Yajra Datatables</h2>
                <a href="" class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#addModal">Add User</a>
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('information_js')
