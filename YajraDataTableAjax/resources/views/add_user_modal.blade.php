<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <form action="" method="post" id="adduserForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Add Users</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer mb-3"></div>
                    <div class="form-group mb-2">
                        <label for="name"><b>User Name</b></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="User Name">
                    </div>
                    <div class="form-group">
                        <label for="email"><b>User Email</b></label>
                        <input type="text" class="form-control" name="email" id="email" placeholder="User Email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add_user">Save User</button>
                </div>
            </div>
        </div>
    </form>
</div>
