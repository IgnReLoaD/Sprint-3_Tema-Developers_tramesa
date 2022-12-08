$(function() {
    
        $(document).on("click", "a#task_list", function(){ getTaskList(this); });
    
    });
    
    function getTaskList(element) {

            $('#indicator').show();
            $.post('Controller.php',
                {
                    action: 'get_task'
                },
                function(data, textStatus) {
                renderUserList(data);
                $('#indicator').hide();
                },
        
                "json"
            );
        }
        function renderUserList(jsonData) {

                var table = '<table width="600" cellpadding="5" class="table table-hover table-bordered"><thead><tr><th scope="col">Description</th><th scope="col">User</th><th scope="col">Created At</th><th scope="col">Start Date</th><th scope="col">End Time</th></tr></thead><tbody>';

                $.each( jsonData, function( index, task){

                table += '<tr>';

                table += '<td class="edit" field="Description" task_id="'+task.id+'">'+task.description+'</td>';

                table += '<td class="edit" field="User" task_id="'+task.id+'">'+task.id+'</td>';

                table += '<td class="edit" field="Created At" task_id="'+task.id+'">'+task.createdAt+'</td>';

                table += '<td class="edit" field="Start Time" task_id="'+task.id+'">'+task.startTime+'</td>';

                table += '<td class="edit" field="End Time" task_id="'+task.id+'">'+task.endTime+'</td>';

                table += '<td><a href="javascript:void(0);" task_id="'+task.id+'" class="delete_confirm btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';

                table += '</tr>';
                });

                table += '</tbody></table>';

                $('div#content').html(table);

            }
            
         
        
    