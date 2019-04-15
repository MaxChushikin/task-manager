// add project START
$(document).ready(function () {

    $('button[class^="accountButton"]').on('click', function () {

        var button = $(this);
        var button_text = $(button).text();
        var form = $(button).closest('form');
        var login = $(form).find('input[id=login]');
        var password = $(form).find('input[id=password]');
        var alert_block = $(form).closest('div').find('div[class^="alert"]');
        var html = '';

        var flag = true;
        if ($(login).val().length < 6 || $(login).val().length > 32 ) {
            $(login).addClass('error');
            flag = false;
        } else {
            $(login).removeClass('error');
        }

        if ($(password).val().length < 6 || $(password).val().length > 32) {
            $(password).addClass('error');
            flag = false;
        } else {
            $(password).removeClass('error');
        }

        if  (flag){
            if ($(button).attr('id') == 'loginButton'){
                var action = 'login';
            } else if ($(button).attr('id') == 'registerButton'){
                var action = 'register';
            } else {
                return;
            }

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'controller/main.php?action=' + action,
                data: form.serialize(),
                beforeSend: function () {
                    $(button).html('<span class="spinner-border spinner-border-sm"></span>  Wait...');
                },
                complete: function () {
                    $(button).html('<span>' + button_text + '</span>');
                },
                success: function (data) {
                    $(alert_block).hide();
                    $(alert_block).html('');

                    if (data['error']) {
                        $('form input').addClass('error');
                        $.each( data['error'], function( i, val ) {
                            html += val;
                        });
                        console.log(html);
                        $(alert_block).show();
                        $(alert_block).html(html);

                    } else {
                        document.location.reload(true);
                    }
                }
            });

        }
    });


    $('#logout').on('click', function () {

        button = $(this);

        var action = 'logout';

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'controller/main.php?action=' + action,
            data: '',
            beforeSend: function () {
                $(button).html('<span class="spinner-border spinner-border-sm"></span>  Wait...');
            },
            complete: function () {
                $(button).html('<span>' + $(button).text()   + '</span>');
            },
            success: function () {
                document.location.reload(true);
            }
        });
    });

    $('#addProjectSubmit').on('click', function () {

        var button = $(this);
        var form = $('#addProjectForm').closest('form');
        var input = $(form).find('input');
        var project_name = $(input).val();


        if (project_name.length < 3) {
            $(input).addClass('error');
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'controller/main.php?action=addProject',
                data: form.serialize(),
                beforeSend: function () {
                    $(button).html('<span class="spinner-border spinner-border-sm"></span>  Wait...');
                },
                complete: function () {
                    $(button).html('<span>Add project</span>');
                },
                success: function (data) {
                    if (data['error']) {
                        $(input).addClass('error');
                        alert(data['error']);
                    } else {
                        html = '<div class="todo-list" data-project_id="' + data['id'] + '">' +
                            ' <div class="todo-list-header"> ' +
                            ' <div class="left"> ' +
                            ' <i class="fa fa-calendar" aria-hidden="true"></i> ' +
                            ' <div class="project-header-title">' +
                            ' <h5 class="project-header-title-element">' + project_name + '</h5> ' +
                            ' </div> ' +
                            ' </div> ' +
                            ' <div class="right"> ' +
                            ' <i class="edit-project fas fa-pencil-alt"></i> ' +
                            ' <i class="remove-project fas fa-trash-alt"></i> ' +
                            ' </div> ' +
                            ' </div> ' +
                            ' <div class="todo-list-body"> ' +
                            ' <table class="table table-hover"> ' +
                            ' <thead> ' +
                            ' <tr> ' +
                            ' <th colspan="3"> ' +
                            ' <div class="input-group"> ' +
                            ' <a href="javascript:void(0)"><i class="fa fa-plus" aria-hidden="true"></i></a> ' +
                            ' <input type="text" name="task-name" class="form-control" placeholder="Start typing here to create a task"> ' +
                            ' <div class="input-group-append"> ' +
                            ' <button class="add-task btn btn-outline-secondary" type="button">Add Task</button> ' +
                            ' </div> ' +
                            ' </div> ' +
                            ' </th> ' +
                            ' </tr> ' +
                            ' </thead> ' +
                            ' <tbody> ' +
                            ' </tbody> ' +
                            ' </table> ' +
                            ' </div> ' +
                            ' </div>';


                        $('.todo-list-container').append(html);
                        $('#addProjectModal').modal('toggle');

                        $(input).removeClass('error');
                        $(input).val('');
                    }
                }
            });
        }
    });

// add project END

// EDIT project START
// add form START
    $('.todo-list-container').on('click', '.edit-project', function () {

        var button = $(this);
        var project_block = $(button).closest('.todo-list').find('.project-header-title');

        var old_name = $(project_block).find('.project-header-title-element').text();

        var html = '<div class="form-group">\n' +
            '           <input type="text" name="project-title" class="form-control" placeholder="Rename this project" value="' + old_name + '">\n' +
            '           <div class="input-group-append">\n' +
            '               <button class="save-project-name btn btn-outline-secondary" type="button"><span>Save</span></button>\n' +
            '           </div>\n' +
            '       </div>';

        $(project_block).html(html);
    });
// add form END

// validate & send to controller START
    $('.todo-list-container').on('click', '.save-project-name', function () {

        var button = $(this);
        var project_id = $(button).closest('.todo-list').data('project_id');
        var input = $(button).parent().prev();
        var project_name = $(input).val();


        if (project_id == 'undefined' || project_name < 1 || project_name == 'undefined' || project_name.length < 3) {
            $(input).addClass('error');
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'controller/main.php?action=editProject',
                data:  'project_id=' + project_id + '&project_name=' + project_name,
                beforeSend: function () {
                    $(button).html('<span class="spinner-border spinner-border-sm"></span>  Wait...');
                },
                complete: function () {
                    $(button).html('<span>Save</span>');
                },
                success: function (data) {
                    if (data['error']) {
                        $(input).addClass('error');
                        alert(data['error']);
                    } else {
                        var html = '<h5 class="project-header-title-element">' + project_name + '</h5>';

                        $(input).removeClass('error');
                        $(button).parent().parent().html(html);
                    }
                }
            });
        }
    });
// validate & send to controller END
// EDIT project END

// REMOVE project START
    $('.todo-list-container').on('click', '.remove-project', function () {
        var element = $(this);
        var project_block = $(element).closest('.todo-list');
        var project_id = $(project_block).data('project_id');

        if (project_id !== 'undefined') {

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'controller/main.php?action=removeProject',
                data: 'project_id=' + project_id,

                success: function (data) {
                    if (data['error']) {
                        alert(data['error']);
                    } else {
                        $(project_block).remove();
                    }
                }
            });
        }
    });
// REMOVE project END


// ADD task START
    $('.todo-list-container').on('click', '.add-task', function () {

        var button = $(this);
        var input = $(button).closest('.input-group').find('input');
        var task_name = $(input).val();
        var project_block = $(button).closest('.todo-list');
        var project_id = $(project_block).data('project_id');


        // Front validation
        if (task_name.length < 3 || project_id == 'undefined') {
            $(input).addClass('error');
        } else {

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'controller/main.php?action=addTask',
                data: 'project_id=' + project_id + '&task_name=' + task_name,
                beforeSend: function () {
                    $(button).html('<span class="spinner-border spinner-border-sm"></span>  Wait...');
                },
                complete: function () {
                    $(button).html('<span>Save</span>');
                },
                success: function (data) {
                    if (data['error']) {
                        $(input).addClass('error');
                        alert(data['error']);
                    } else {
                        html = '<tr data-task_id="' + data['task_id'] + '">' +
                            '<td class="checkbox">' +
                            '<div class="custom-control custom-checkbox">' +
                            '<input type="checkbox" class="custom-control-input" id="status' + data['task_id'] + '">' +
                            '<label class="custom-control-label" for="status' + data['task_id'] + '"></label>' +
                            '</div>' +
                            '</td>' +
                            '<td class="task-title">' + task_name + '</td>' +
                            '<td class="operate">' +
                            '<i class="sort-task fas fa-sort"></i>' +
                            '<i class="edit-task fas fa-pencil-alt"></i>' +
                            '<i class="remove-task fas fa-trash-alt"></i>' +
                            '</td>' +
                            '</tr>';

                        $(project_block).find('tbody').append(html);

                        $(input).removeClass('error');
                        $(input).val('');
                    }
                }
            });
        }
    });
// ADD task END

// EDIT task START
// add form START
    $('.todo-list-container').on('click', '.edit-task', function () {

        var button = $(this);
        var task_block = $(button).closest('tr').find('.task-title');

        var old_name = $(task_block).text();

        var html = '<div class="form-group">\n' +
            '           <input type="text" name="task-title" class="form-control" placeholder="Rename this task" value="' + old_name + '">\n' +
            '           <div class="input-group-append">\n' +
            '               <button class="save-task-name btn btn-outline-secondary" type="button"><span>Save</span></button>\n' +
            '           </div>\n' +
            '       </div>';

        $(task_block).html(html);
    });
// add form END

// validate & send to controller START
    $('.todo-list-container').on('click', '.save-task-name', function () {

        var button = $(this);
        var task_id = $(button).closest('tr').data('task_id');
        var input = $(button).parent().prev();
        var task_name = $(input).val();
        var task_block = $(button).closest('td');


        if (task_id == 'undefined' || task_name < 1 || task_name == 'undefined' || task_name.length < 3) {
            $(input).addClass('error');
        } else {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'controller/main.php?action=editTask',
                data:  'task_id=' + task_id + '&task_name=' + task_name,
                beforeSend: function () {
                    $(button).html('<span class="spinner-border spinner-border-sm"></span>  Wait...');
                },
                complete: function () {
                    $(button).html('<span>Save</span>');
                },
                success: function (data) {
                    if (data['error']) {
                        $(input).addClass('error');
                        alert(data['error']);
                    } else {
                        var html = task_name;

                        $(input).removeClass('error');
                        $(task_block).html(html);
                    }
                }
            });
        }
    });
// validate & send to controller END
// EDIT task END


// Checkbox status Task START
    $('.todo-list-container').on('change', 'input[id^="status"]', function () {
        var element = $(this);
        var task_id = $(element).closest('tr').data('task_id');
        var status = $(element).prop('checked');

        if (task_id !== 'undefined') {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'controller/main.php?action=editTask',
                data: 'task_id=' + task_id + '&status=' + status,

                success: function (data) {
                    if (data['error']) {
                        alert(data['error']);
                    }
                }
            });
        }
    });
// Checkbox status Task END

// Checkbox status Task START
    $('.todo-list-container').on('click', 'td[class="priority"] button[class="dropdown-item"]', function () {

        var element = $(this);
        var task_id = $(element).closest('tr').data('task_id');
        var priority = $(element).data('priority');

        var button = $(element).closest('td').find('button[id^="priority"]');


        if (task_id !== 'undefined' && priority >= 1 && priority <= 3) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'controller/main.php?action=editTask',
                data: 'task_id=' + task_id + '&priority=' + priority,

                success: function (data) {
                    if (data['error']) {
                        alert(data['error']);
                    }

                    $(button).html(element.text());
                }
            });
        }
    });
// Checkbox status Task END

// REMOVE task START
    $('.todo-list-container').on('click', '.remove-task', function () {

        var element = $(this);
        var task_block = $(element).closest('tr');
        var task_id = $(task_block).data('task_id');

        if (task_id !== 'undefined') {

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'controller/main.php?action=removeTask',
                data: 'task_id=' + task_id,

                success: function () {
                    $(task_block).remove();
                }
            });
        }
    });
// REMOVE task END





});


