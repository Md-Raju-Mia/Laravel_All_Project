<div class="modal fade" id="up_Modal" tabindex="-1" aria-labelledby="up_ModalLabel" aria-hidden="true">
    <form method="post" id="updateUserForm">
        @csrf
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="up_ModalLabel">Update Users</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="errMsgContainer mb-3"></div>
                    <div class="form-group mb-2">
                        <label for="up_name"><b>User Name</b></label>
                        <input type="text" class="form-control" name="up_name" id="up_name" placeholder="User Name">
                    </div>
                    <div class="form-group">
                        <label for="up_email"><b>User Email</b></label>
                        <input type="text" class="form-control" name="up_email" id="up_email" placeholder="User Email">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary up_user">Update User</button>
                </div>
            </div>
        </div>
    </form>
</div>
