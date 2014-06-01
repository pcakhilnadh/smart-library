
		var rowNum = 0;
var c=1;
function addRow() {
rowNum ++;

var row = '<label  class=" control-label"><p  id="rowNum'+rowNum+'">Author Name : </label><input  class="form-control form-group"  type="text" value="" name="'+c+'"  /><input type="hidden" value=" '+c+'" name="count" /><input type="button" value="Remove This Author " class="btn-sm btn-warning " onclick="removeRow('+rowNum+');"></p>';
jQuery('#itemRows').append(row);
c ++;
}

function removeRow(rnum) {
jQuery('#rowNum'+rnum).remove();
}
