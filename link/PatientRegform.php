<div id="regForm" class="modal hide fade">
	<div class="modal-dialog">
    		<div class="modal-content">
            	<div class="modal-header">
                <button class="close" type="button" data-dismiss="modal" aria-hidden="hidden">&times;</button>
                <h3 class="modal-title h-line">Patient registration form</h3>
                <div class="modal-body font">
                <div class="instruction-box"><span class="icon-info-sign"></span>
                Enter the patient information to register.
                </div>
                
                
                <form role="form" class="form-actions" method="post" enctype="multipart/form-data">
          <div class="form-group">
          <table>
          <tr><td>Name :</td> 
          <td><input type="text" name="Name" id="Name" class="input-xlarge" placeholder="Name" /></td></tr>
          <tr><td>Date of birth "mm/dd/yy" :</td> 
          <td><input name="dob" type="text" class="input-xlarge" id="dob" maxlength="15" placeholder="Enter pateient date of birth" /></td></tr>
         <tr><td>Gender :</td>  
         <td><select name="gender" id="gender" class="input-xlarge">
      <option selected="selected">Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
          </select></td></tr>
          <tr><td>Phone number :</td> 
          <td><input type="text" name="phone" id="phone" class="input-xlarge" placeholder="Phone Number (e.g 070XXXXXXXX)" maxlength="11"/></td></tr>
          <tr><td>Patient type :</td>
          <td><select name="type" id="type" class="input-xlarge">
                  <option value="Out patient">Out patient</option>
                  <option value="In patient">In patient</option>
          	</select></td></tr>
          <tr><td>Patient ID :</td>
          <td>
          <input type="text" name="pid" id="pid" class="input-xlarge" placeholder="Patient ID" maxlength="11"/>
          </td></tr>
          <tr><td>
          Upload passport :</td><td> <input type="file" name="passport" />
          </td>
          </tr>
          </table>
          </div>
          </br>
          <div>
          <button type="submit" class="btn btn-danger btn-block" name="register">Submit</button>
          </div>
            </div>
          </form>
                	
                </div>
<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>                
                </div>
            </div>
    </div>
</div>