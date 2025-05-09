<?php include 'session/session_input.php'; ?>
<!doctype html>
<html lang="en">


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

<head>

    <meta charset="utf-8" />
    <title>
        Survey Questions |
        <?php echo $_SESSION['user_name']; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Byco" name="description" />
    <meta content="Byco" name="author" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- App favicon -->

    <?php include 'css_script.php'; ?>


</head>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 7px;
        left: 0;
        right: 8px;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 20px;
        width: 20px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(21px);
        -ms-transform: translateX(21px);
        transform: translateX(21px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

<body>

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">


        <?php include 'header.php'; ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php include 'sidebar.php'; ?>

        <!-- Left Sidebar End -->


        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <?php include 'right_siebar.php'; ?>

        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-6">
                            <button class="btn btn-soft-primary waves-effect waves-light" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" id="add_btn"
                                aria-controls="offcanvasRight"><i
                                    class="bx bxs-add-to-queue font-size-16 align-middle me-2 cursor-pointer"></i>Add</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h3>Survey Questions</h3>

                            <table id="myTable" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Category</th>
                                        <th>Questions</th>
                                        <th>File</th>
                                        <th>Active/Inactive</th>
                                        <th>Department</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include 'footer.php'; ?>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->


    <!-- Right Sidebar -->

    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- chat offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasRightLabel">Questions</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                <form method="post" id="insert_form" enctype="multipart/form-data">

                    <div class="form-row mb-4">
                        <div class="form-group col-md-12">
                            <label for="example-text-input" class="col-md-2 col-form-label">Category</label>

                            <select class="form-control  " name="category" id="category"
                                placeholder="This is a search placeholder">
                            </select>
                        </div>






                    </div>


                    <div class="row mb-3 input_fields_wrap">
                        <!-- <div class="input_fields_wrap"> -->

                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Questions </label>
                            <input type="text" class="form-control" id="questions" name="questions[]" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Image Required </label>
                            <select class="form-control  " name="file_req[]" id="file_req">
                                <option value="">Select</option>
                                <option value="required">Image Required</option>
                                <option value="not_required">Image Not Required</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Answer </label>
                            <select class="form-control  " name="answer[]" id="answer">
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                <option value="N/A">N/A</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Action TIme (Hours)</label>
                            <input type="number" class="form-control" id="action_time" name="action_time[]" step="1">

                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputEmail4">Department </label>
                            <select class="form-control select_" name="dpt[]"  id="dpt_1"
                                data-select="selectedValues_1">
                                <option value="">Select</option>

                            </select>
                            <input type="hidden" name="selectedValues[]" id="selectedValues_1">
                        </div>


                    </div>
                    <div class="row my-3" id="updated_child">
                        <div class="col-md-12">
                            <button class="add_field_button  btn rounded-pill btn-primary" style="float: right;">Add
                                Add Question
                            </button>

                        </div>

                    </div>



                    <div class="col-12">
                        <input type="hidden" name="row_id" id="row_id" value="">
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

    <!-- JAVASCRIPT -->

    <?php include 'script_tags.php'; ?>

    <script>
        var table;
        var type;
        var subtype;
        $(document).ready(function () {
            $('.select_').select2();
            dpt(1);

            $('.select_').on('change', function () {
                // var selectedValues = $(this).val();

                var selectedValues = $(this).map(function () {
                    return $(this).val();
                }).get().join(',');
                var dataSelectValue = $(this).data('select');

                $('#' + dataSelectValue + '').val(selectedValues);
                console.log(selectedValues); // You can remove this line; it's just for demonstration
            });
            var max_fields = 100; //maximum input boxes allowed
            var wrapper = $(".input_fields_wrap"); //Fields wrapper
            var add_button = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function (e) { //on add input button click
                e.preventDefault();
                if (x < max_fields) { //max input box allowed
                    x++; //text box increment
                    $(wrapper).append(
                        '<div style="border:1px solid"><div class="row mb-3 row mb-3 mt-3"><div class="col-md-6"><label class="form-label">Question</label><input class="form-control price" id="questions" name="questions[]" required></div><div class="form-group col-md-6"><label for="inputEmail4">Image Required</label><select class="form-control" name="file_req[]" id="file_req"><option value="">Select</option><option value="required">Image Required</option><option value="not_required">Image Not Required</option></select></div></div><div class="form-group col-md-12"><label for="inputEmail4">Answer</label><select class="form-control" name="answer[]" id="answer"><option value="">Select</option><option value="Yes">Yes</option><option value="No">No</option><option value="N/A">N/A</option></select></div><div class="form-group col-md-12"><label for="inputEmail4">Action TIme (Hours)</label><input type="number" class="form-control" id="action_time" name="action_time[]" min="0"  step="1" ></div><div class="form-group col-md-12"><label for="inputEmail4">Department</label><select class="form-control select_" name="dpt[]"  id="dpt_' +
                        x +
                        '" data-select="selectedValues_' + x +
                        '"><option value="">Select</option></select><input type="hidden" name="selectedValues[]" id="selectedValues_' +
                        x +
                        '"></div><a href="#" class="remove_field btn btn-danger" style="float:right">X</a></div>'
                    ); //add input box
                    dpt(x);
                    $('.select_').select2();
                    $('.select_').on('change', function () {
                        // var selectedValues = $(this).val();

                        var selectedValues = $(this).map(function () {
                            return $(this).val();
                        }).get().join(',');
                        var dataSelectValue = $(this).data('select');

                        $('#' + dataSelectValue + '').val(selectedValues);
                        console.log(
                            selectedValues
                        ); // You can remove this line; it's just for demonstration
                    });
                }
            });

            $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
                e.preventDefault();
                $(this).parent('div').remove();
                // x--;
            })
            $.ajax({
                url: "<?php echo $api_url; ?>get/get_survey_category.php?key=03201232927&id=<?php echo $_SESSION['user_id'] ?>",
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#category').empty();
                    $('#category').append($('<option>', {
                        value: '',
                        text: 'Select'
                    }));
                    // Iterate through the data and append options to the select element
                    $.each(data, function (index, item) {
                        $('#category').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });

                    // Refresh the Select2 element to display the newly added options
                    $('#category').trigger('change.select2');
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });

            $("#role").on("change", function () {
                var selectedRole = $(this).val();
                // Hide all secondary dropdowns
                $("#salesRole, #zmRole, #tmRole,#logisticsSelect").hide();
                if (selectedRole === "Sales") {
                    $("#salesRole").show();
                } else if (selectedRole === "Logistics") {
                    $("#logisticsSelect").show();
                }
            });

            $("#sales").on("change", function () {
                var selectedSalesRole = $(this).val();
                // alert(selectedSalesRole)
                // Hide all secondary dropdowns
                $("#zmRole, #tmRole").hide();
                if (selectedSalesRole === "TM") {
                    $("#zmRole").show();
                } else if (selectedSalesRole === "ASM") {
                    $("#tmRole").show();
                }
            });

            table = $('#myTable').DataTable({
                dom: 'Bfrtip',


                buttons: ['copy', 'excel', 'csv', 'pdf', 'print']

            });
            fetchtable();
            $('#add_btn').click(function () {

                $('#row_id').val("");
                $('#insert').val("Insert");


                $('#insert_form')[0].reset();

                $("#dpt_1").val([]);

                // Trigger the change event on the Select2 element
                $("#dpt_1").trigger("change");
                $('#updated_child').removeClass('d-none')
                // alert("running")

            });

            $('#insert_form').on("submit", function (event) {
                event.preventDefault();
                // alert("Name")
                var data = new FormData(this);
                let r_id = $('#row_id').val();
                if (r_id == "") {
                    
                    $.ajax({
                    url: "<?php echo $api_url; ?>create/survey_questions.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: "POST",
                    data: data,
                    beforeSend: function () {
                        $('#insert').val("Saving");
                        document.getElementById("insert").disabled = true;

                    },
                    success: function (data) {
                        console.log(data)

                        if (data != 1) {
                            Swal.fire(
                                'Server Error!',
                                'Record Not Created',
                                'error'
                            )
                            $('#insert').val("Save");
                            document.getElementById("insert").disabled = false;
                        } else {


                            setTimeout(function () {
                                Swal.fire(
                                    'Success!',
                                    'Record Created Successfully',
                                    'success'
                                )
                                $('#insert_form')[0].reset();
                                $('#offcanvasRight').modal('hide');
                                fetchtable();
                                $("#salesRole, #zmRole, #tmRole,#logisticsSelect")
                                    .hide();
                                $('#insert').val("Save");
                                document.getElementById("insert").disabled = false;

                                location.reload();


                            }, 2000);

                        }

                    },
                    error: function (xhr, status, error) {
                        // Handle API errors
                        console.log('Error:', error);
                        console.log('Status:', status);
                        console.log('Response:', xhr.responseText);
                    }
                });
                }
                else {
                    $.ajax({
                    url: "<?php echo $api_url; ?>update/update_survey_question.php",
                    cache: false,
                    contentType: false,
                    processData: false,
                    method: "POST",
                    data: data,
                    beforeSend: function () {
                        $('#insert').val("Saving");
                        document.getElementById("insert").disabled = true;

                    },
                    success: function (data) {
                        console.log(data)

                        if (data != 1) {
                            Swal.fire(
                                'Server Error!',
                                'Record Not Created',
                                'error'
                            )
                            $('#insert').val("Save");
                            document.getElementById("insert").disabled = false;
                        } else {


                            setTimeout(function () {
                                Swal.fire(
                                    'Success!',
                                    'Record Created Successfully',
                                    'success'
                                )
                                $('#insert_form')[0].reset();
                                $('#offcanvasRight').modal('hide');
                                fetchtable();
                                $("#salesRole, #zmRole, #tmRole,#logisticsSelect")
                                    .hide();
                                $('#insert').val("Save");
                                document.getElementById("insert").disabled = false;

                                location.reload();


                            }, 2000);

                        }

                    },
                    error: function (xhr, status, error) {
                        // Handle API errors
                        console.log('Error:', error);
                        console.log('Status:', status);
                        console.log('Response:', xhr.responseText);
                    }
                });

                }

            });
            load_all_select();
        })


        function all_dealers() {

            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            fetch("<?php echo $api_url; ?>get/dealers.php?key=03201232927", requestOptions)
                .then(response => response.json())
                .then(response => {
                    console.log(response)

                    table.clear().draw();
                    $.each(response, function (index, data) {

                        // Create a new option element
                        var newOption = $('<option>', {
                            value: data.id,
                            text: data.name
                        });

                        // Append the new option to the select
                        $('#dealers').append(newOption);

                        // Trigger the change event to notify Select2 about the update
                        $('#dealers').trigger('change');
                    });
                })
                .catch(error => console.log('error', error));


        }


        function fetchtable() {
            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };

            fetch("<?php echo $api_url; ?>get/survey_questions.php?key=03201232927", requestOptions)
                .then(response => response.json())
                .then(response => {
                    console.log(response); // For debugging

                    table.clear().draw();

                    if (Array.isArray(response)) {
                        $.each(response, function (index, data) {
                            table.row.add([
                                index + 1,
                                data.category_id,
                                data.question,
                                data.file,
                                // Status switch
                                '<label class="switch">' +
                                '<input type="checkbox" id="checkbox_' + data.id + '" onclick="check(' + data.id + ')" ' +
                                (data.status == 1 ? 'checked' : '') +
                                '>' +
                                '<span class="slider round"></span></label>',
                                // Department names (converted in API)
                                data.dpt,
                                // Edit button
                                '<button type="button" id="edit" name="edit" onclick="editData(' + data.id + ')" class="btn btn-soft-danger waves-effect waves-light">' +
                                '<i class="bx bx-edit-alt font-size-16 align-middle"></i></button>',
                                // Delete button
                                '<button type="button" id="delete" name="delete" onclick="deleteData(' + data.id + ')" class="btn btn-soft-danger waves-effect waves-light">' +
                                '<i class="bx bx-trash-alt font-size-16 align-middle"></i></button>'
                            ]).draw(false);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching survey questions:', error);
                    // alert('Error fetching data');
                });
        }


        function check(id) {
    // Get the value of the checkbox (0 for unchecked, 1 for checked)
    var checkboxValue = $('#checkbox_' + id).is(':checked') ? 1 : 0;

    $.ajax({
        type: 'POST',
        url: '<?php echo $api_url; ?>update/survey_question.php', // Replace with the path to your PHP script
        data: {
            checkboxValue: checkboxValue,
            id: id
        },
        success: function (response) {
            console.log('Record updated successfully.');
            alert('Status updated successfully!');
        },
        error: function (error) {
            console.error('Error updating database:', error);
        }
    });
}

        function load_all_select() {

            $.ajax({
                url: '<?php echo $api_url; ?>get/get_tm.php?key=03201232927',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#zm').empty();

                    // Iterate through the data and append options to the select element
                    $.each(data, function (index, item) {
                        $('#tm').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });

                    // Refresh the Select2 element to display the newly added options
                    $('#tm').trigger('change.select2');
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });

            $.ajax({
                url: '<?php echo $api_url; ?>get/get_zm.php?key=03201232927',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#zm').empty();
                    console.log('ZM')
                    console.log(data)
                    // Iterate through the data and append options to the select element
                    $.each(data, function (index, item) {
                        $('#zm').append($('<option>', {
                            value: item.id,
                            text: item.name
                        }));
                    });

                    // Refresh the Select2 element to display the newly added options
                    $('#zm').trigger('change.select2');
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });




        }

        function dpt(id) {
            var requestOptions = {
                method: 'GET',
                redirect: 'follow'
            };
            fetch("<?php echo $api_url; ?>get/get_departments_name.php?key=03201232927", requestOptions)
                .then(response => response.json())
                .then(async result => {
                    console.log(result);
                    if (result.length > 0) {
                        // Dynamically create tabs
                        $('#dpt_' + id + '').empty();
                        $('#dpt_' + id + '').append($('<option>', {
                            value: '',
                            text: 'Select'
                        }));
                        $.each(result, async function (index, tab) {
                            var tabId = tab.id;

                            // Iterate through the data and append options to the select element

                            $('#dpt_' + id + '').append($('<option>', {
                                value: tab.id,
                                text: tab.name
                            }));

                            // Refresh the Select2 element to display the newly added options
                            $('#dpt_' + id + '').trigger('change.select2');

                            // Add tab link

                        });
                    }
                })
                .catch(error => console.log('error', error));
        }

        function deleteData(id) {

            var result = confirm("Are you sure you want to proceed?");

            // Check the user's choice
            if (result) {
                // User clicked OK, proceed with the action


                var settings = {
                    "url": "<?php echo $api_url; ?>delete/delete_questions.php?key=03201232927&id=" + id + "",
                    "method": "GET",
                    "timeout": 0,
                };

                $.ajax({
                    ...settings,
                    statusCode: {
                        200: function (response) {
                            Swal.fire(
                                'Success!',
                                'Record Deleted Successfully',
                                'success'
                            )
                            setTimeout(function () {

                                location.reload();


                            }, 2000);

                        },
                        success: function (data) {
                            // Additional success handling if needed
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            Swal.fire(
                                'Server Error!',
                                'Record Not Deleted',
                                'error'
                            )

                            // console.log("Request failed with status code: " + xhr.status);
                        }
                    }
                })
            }

        }

        function editData(id) {

            var settings = {
                "url": "<?php echo $api_url; ?>get/get_survey_questionsss.php?key=03201232927&id=" + id + "",
                "method": "GET",
                "timeout": 0,
            };

            $.ajax({
                ...settings,
                statusCode: {
                    200: function (response) {
                        console.log(response);

                        $('#row_id').val(response[0]['id'])
                        $('#category').val(response[0]['category_id'])
                        $('#questions').val(response[0]['question'])
                        $('#file_req').val(response[0]['file'])
                        $('#answer').val(response[0]['answer'])
                        $('#action_time').val(response[0]['duration'])

                        var dpt = response[0]['dpt'];
                        var arr = dpt.split(",");
                        $("#dpt_1").val(arr);

                        // Trigger the change event on the Select2 element
                        $("#dpt_1").trigger("change");
                        $('#updated_child').addClass('d-none');
                        $('#insert').val('Update')
                        console.log(arr);


                        // $('#name').val(response[0]['sizes']);

                    }
                }
            })
            $('#offcanvasRight').offcanvas('show');

        }
    </script>
</body>


<!-- Mirrored from themesdesign.in/webadmin/layouts/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 25 Sep 2023 10:08:03 GMT -->

</html>