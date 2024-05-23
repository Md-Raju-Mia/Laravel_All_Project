<script>
	$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize DataTable with server-side processing
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('users.get') }}",
            type: 'GET'
        },
        pageLength: 10,
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });



	 // Handle form submission
        $(document).on('click', '.add_user', function(e) {
            e.preventDefault();

            var name = $('#name').val();
            var email = $('#email').val();
            $('.errMsgContainer').html('');

            $.ajax({
                url: "{{ route('users.store') }}",
                method: 'POST',
                data: {
                    name: name,
                    email: email
                },
                success: function(res) {
                    if (res.status == 'success') {
                        $('#addModal').modal('hide');
                        $('#adduserForm')[0].reset();
                        table.draw();  // Refresh DataTable
                    }
                },
                error: function(err) {
                    if (err.status === 422) {
                        var errors = err.responseJSON.errors;
                        $.each(errors, function(index, value) {
                            $('.errMsgContainer').append('<span class="text-danger">' + value + '</span><br>');
                        });
                    }
                    if (err.status === 500) {
                        $('.errMsgContainer').append('<span class="text-danger">Internal Server Error</span><br>');
                    }
                }
            });
        });

    // Handle edit button click
    $(document).on('click', '.edit', function() {
        var userId = $(this).closest('tr').find('td:first').text(); 
        
        
        $.ajax({
            url: "/users/" + userId + "/edit", // Fetch user details
            type: "GET",
            success: function(response) {
                
                $('#up_name').val(response.name);
                $('#up_email').val(response.email); 
                $('#up_Modal').data('userId', userId); 
                $('#up_Modal').modal('show');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Handle update button click
	$(document).on('click', '.up_user', function(e) {
        e.preventDefault();

        var userId = $('#up_Modal').data('userId');
        var name = $('#up_name').val();
        var email = $('#up_email').val();
        $('.errMsgContainer').html('');

        $.ajax({
            url: "/users/" + userId,
            type: "POST",
            data: {
               
                name: name,
                email: email
            },
            success: function(res) {
                if (res.status == 'success') {
                    $('#up_Modal').modal('hide');
                    table.draw();
                }
            },
            error: function(err) {
                if (err.status === 422) {
                    var errors = err.responseJSON.errors;
                    $.each(errors, function(index, value) {
                        $('.errMsgContainer').append('<span class="text-danger">' + value + '</span><br>');
                    });
                }
                if (err.status === 500) {
                    $('.errMsgContainer').append('<span class="text-danger">Internal Server Error</span><br>');
                }
            }
        });
    });


	//delete row
			$(document).on('click', '.delete', function(e) {
			e.preventDefault();

			if (!confirm("Are you sure you want to delete this user?")) {
				return;
			}

			var userId = $(this).closest('tr').find('td:first').text(); 

			$.ajax({
				url: "/users/" + userId + "/delete",
				type: "POST",
				success: function(res) {
					if (res.status == 'success') {
						table.draw(); 
					}
				},
				error: function(err) {
					alert("An error occurred while trying to delete the user.");
				}
			});
		});


    // Reset form on modal hide
    $('#up_Modal').on('hidden.bs.modal', function () {
        $('#up_Modal').removeData('userId'); 
        $('#updateUserForm')[0].reset();
        $('.errMsgContainer').html('');
    });
});
</script>