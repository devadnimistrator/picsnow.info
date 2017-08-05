<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="page-title">
  <div class="title_left">
    <h3><?php echo $this->page_title?></h3>
  </div>
</div>
<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">						
				<h2>Users</h2>
				<!--ul class="nav navbar-right panel_toolbox">
        	<li><a class="collapse-link" href="<?php echo base_url("admin/users/add"); ?>"><button type="button" class="btn btn-round btn-primary btn-xs">&nbsp;&nbsp;New User&nbsp;&nbsp;</button></a></li>
        </ul-->
        <div class="clearfix"></div>
			</div>
			<div class="x_content">
        <table id="table-users" class="table table-striped table-bordered" width="100%">
          <thead>
            <tr>
            	<th class="nosort">No</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Is Membership?</th>
              <th>Last Access</th>
              <th class="nosort">Actions</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
	</div>
</div>

<!-- Datatables -->
<?php $this -> load -> view('admin/common/table.js.php'); ?>
<script>
	var $tableUsers;
	$(document).ready(function() {
		$tableUsers = $('#table-users').DataTable({
			columns: [
		    { "data": "user_id" },
		    { "data": "fullname" },
		    { "data": "email" },
		    { "data": "phone" },
		    { "data": "is_membership" },
		    { "data": "last_access" },
		    { "data": "user_id" },
		  ],
		  order : [[5, "desc"]],
			processing : true,
			serverSide : true,
			ajax : "<?php echo base_url("admin/users/ajax_find"); ?>",
			aoColumnDefs : [{
				'bSortable' : false,
				'aTargets' : ['nosort']
			}],
			responsive : true,
			createdRow : function(row, data, index) {
				$action_col = $(row).find('td:last-child');
				
				$action_html = '<a href="<?php echo base_url('admin/users/edit'); ?>/' + data['id'] + '" title="Edit"><i class="fa fa-edit"></i></a>';
				$action_html += '&nbsp;|&nbsp;';
				$action_html += '<a href="javascript:delete_user(' + data['id'] + ')" title="Delete"><i class="fa fa-remove"></i></a>';
				
				$action_col.html($action_html);
				
				$(row).attr('id', data['id']);
				
				$(row).dblclick(function() {
					location.href='<?php echo base_url('admin/users/edit'); ?>/' + $(this).attr('id');
				});
			},
			
		});
	
		$tableUsers.on('order.dt search.dt', function() {
			$tableUsers.column(0, {
				search : 'applied',
				order : 'applied'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1;
			});
		}).draw();
	});

	function delete_user(userid) {
		if (confirm("Are you sure delete selected user?")) {
			$.get("<?php echo base_url('admin/users/ajax_delete')?>/" + userid, function() {
				$tableUsers.row($("#user-" + userid)).remove().draw();
			})
		}
	}
</script>