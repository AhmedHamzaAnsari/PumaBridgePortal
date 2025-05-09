<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>
        Totelizer Request | <?php echo $_SESSION['user_name']; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php include 'css_script.php'; ?>
</head>

<body>

    <div id="layout-wrapper">
        <?php include 'header.php'; ?>
        <?php include 'sidebar.php'; ?>
        <?php include 'right_siebar.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row"></div>
                    <div class="card">
                        <div class="card-body">
                            <h3>Totelizer Request</h3>

                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Dealer</th>
                                        <th>Dispencer</th>
                                        <th>Tank</th>
                                        <th>Nozzel</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Last Reading</th>
                                        <th>Created By</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <?php include 'footer.php'; ?>

        </div>
    </div>

    <div class="rightbar-overlay"></div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasRightLabel">Sizes</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                <form method="post" id="insert_form" enctype="multipart/form-data">
                    <div class="form-row mb-4">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Sizes</label>
                            <input type="number" class="form-control" id="name" name="name" required>
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="hidden" name="row_id" id="row_id" value="0">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id'] ?>">
                        <div class="mb-3 row">
                            <label for="example-text-input" class="col-md-10 col-form-label"></label>
                            <div class="col-md-12 text-center">
                                <input class="btn rounded-pill btn-primary" type="submit" name="insert" id="insert"
                                    value="Save">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'script_tags.php'; ?>

    <script>
        const userId = <?php echo isset($_SESSION['user_id']) ? (int) $_SESSION['user_id'] : 'null'; ?>;
        const key = '03201232927';

        var table;
        $(document).ready(function () {
            table = $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'pdf', 'print']
            });
            fetchtable();
        });

        function fetchtable() {
            if (!userId) {
                alert("User ID is not available.");
                return;
            }

            const apiUrl = "<?php echo $api_url; ?>get/all_totelizer_request.php";
            const fullUrl = `${apiUrl}?key=${key}&user_id=${userId}`;

            fetch(fullUrl, {
                method: 'GET'
            }).then(response => response.json())
                .then(response => {
                    console.log(response);
                    table.clear().draw();

                    if (response.length === 0) {
                        console.log("No data found");
                        return;
                    }

                    $.each(response, function (index, data) {
                        // alert(data.dealer_id)
                        var status = data.status === "active" ? "Active" : data.status === "rejected" ? "Rejected" : "Pending";
                        table.row.add([
                            index + 1,
                            data.dealer_name,
                            data.dispenser_name,
                            data.tank_name,
                            data.nozzel_name,
                            status,
                            getActionButtons(data.totelizer_id, data.status, data.dealer_id),
                            data.lr || 'N/A',
                            data.tm_name,
                            data.created_at
                        ]).draw(false);
                    });
                })
                .catch(error => console.log('error', error));
        }
        function getActionButtons(id, status, dealer_id) {
            const userId = <?php echo $_SESSION['user_id'] ?? 'null'; ?>;

            if (!userId) return ''; // No session, no action

            let actionButtons = '';

            if (status === "0") {
                // Show action button (hamburger icon)
                actionButtons = `
            <button type="button" class="btn btn-soft-primary waves-effect waves-light" 
                    onclick="showActionAlert(${id}, ${dealer_id}, '${status}')">
                <i class="fas fa-bars font-size-16 align-middle"></i>
            </button>`;
            } else if (status === "rejected") {
                // Show red flag for rejected only
                actionButtons = `
            <span class="badge bg-danger">
                <i class="fas fa-flag"></i> Rejected
            </span>`;
            }

            // If status is "1" (approved), return nothing so it disappears from page
            return actionButtons;
        }



        function fetchTotelizerTable() {
            if (!userId) {
                alert("User ID is not available.");
                return;
            }

            const apiUrl = "<?php echo $api_url; ?>get/all_totelizer_request.php";
            const fullUrl = `${apiUrl}?key=${key}&user_id=${userId}`;

            fetch(fullUrl, {
                method: 'GET'
            })
                .then(response => response.json())
                .then(response => {
                    console.log("Totelizer data:", response);
                    table.clear().draw();

                    if (!Array.isArray(response) || response.length === 0) {
                        console.log("No data found");
                        return;
                    }

                    response.forEach((data, index) => {
                        console.log("Data:", data.totelizer_id, data.status, data.dealerId);
                        // âœ… Only show pending records (optional)
                        if (data.status === "1" || data.status === "active") return;

                        var status = data.status === "active" ? "Active" : data.status === "rejected" ? "Rejected" : "Pending";
                        table.row.add([
                            index + 1,
                            data.dealer_name,
                            data.dispenser_name,
                            data.tank_name,
                            data.nozzel_name,
                            status,
                            getActionButtons(data.totelizer_id, data.status, data.dealer_id),
                            data.lr || 'N/A',
                            data.tm_name,
                            data.created_at
                        ]).draw(false);
                    });
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                });
        }

        function showActionAlert(taskId, dealerId, status) {
            Swal.fire({
                title: 'Choose an action',
                text: 'Do you want to approve or reject this request?',
                icon: 'warning',
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonText: 'Approve',
                denyButtonText: 'Reject',
                cancelButtonText: 'Close',
                confirmButtonColor: '#28a745',  // Green
                denyButtonColor: '#ffc107',     // Yellow
                cancelButtonColor: '#d33',      // Red
                reverseButtons: false,          // Custom order: Approve (left), Reject (middle), Close (right)
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // âœ… Approve clicked
                    approveRequest(taskId, dealerId);
                } else if (result.isDenied) {
                    // âš ï¸ Reject clicked â€” ask for confirmation before delete
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This request will be permanently Rejected!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, Reject it!',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d'
                    }).then((confirmResult) => {
                        if (confirmResult.isConfirmed) {
                            rejectRequest(taskId, dealerId); // ðŸš¨ Proceed with delete
                        }
                    });
                }
            });
        }


        function approveRequest(taskId, dealersId) {
            console.log("task", taskId, dealersId)
            const userId = <?php echo $_SESSION['user_id']; ?>;

            if (userId === null) {
                Swal.fire({
                    title: 'Error!',
                    text: 'User is not authenticated.',
                    icon: 'error'
                });
                return;
            }

            const formData = new FormData();
            formData.append('task_id', taskId);
            formData.append('dealer_id', dealersId);
            formData.append('key', '03201232927');
            formData.append('user_id', userId);

            fetch('<?php echo $api_url; ?>update/update_totelizer_request.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        Swal.fire('Approved!', data.message || 'Request has been approved.', 'success');
                        fetchTotelizerTable(); // Refresh table after approval
                    } else {
                        Swal.fire('Error!', data.message || 'Operation failed.', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'Request failed. Please try again.', 'error');
                });
        }

        function rejectRequest(taskId, dealerId) {
            const userId = <?php echo $_SESSION['user_id']; ?>;

            if (!userId) {
                Swal.fire({
                    title: 'Error!',
                    text: 'User is not authenticated.',
                    icon: 'error'
                });
                return;
            }

            const formData = new FormData();
            formData.append('task_id', taskId);
            formData.append('dealer_id', dealerId); // Ensure the dealerId is being passed correctly
            formData.append('key', '03201232927');
            formData.append('user_id', userId);

            console.log("Sending Task ID:", taskId);
            console.log("Sending Dealer ID:", dealerId);

            fetch('<?php echo $api_url; ?>update/reject_totelizer_request.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status) {
                        Swal.fire('Rejected!', data.message || 'Request has been rejected.', 'success');
                        fetchTotelizerTable(); // Refresh table after rejection
                    } else {
                        Swal.fire('Error!', data.message || 'Operation failed.', 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error!', 'Request failed. Please try again.', 'error');
                });
        }


    </script>
</body>

</html>