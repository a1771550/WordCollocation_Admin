/**
 * Created by kevinlau on 10/12/16.
 */
if ($('.create-ex').length)
{
	var url = $.url(window.location.href);
	var isUpdate = url.attr('query').indexOf('id')>=0;
	console.log('is update: '+isUpdate);
	var offset=0;
	var html=null;
	if(isUpdate){
		offset = $('#exampleCount').val();
		console.log('offset: '+offset);
	}

	var clickCount = 0;
	$('.create-ex').click(function (e)
	{
		clickCount++;
		e.preventDefault();
		var eng = $('#engText').val();
		var zht = $('#zhtText').val();
		var zhs = $('#zhsText').val();
		var jap = $('#japText').val();
		var del = $('#delexText').val();
		var oxf = $('#oxfordText').val();
		var newd = $('#newDictText').val();
		var source = $('#sourceText').val();
		var remark = $('#remarkText').val();
		var news = $('#newsText').val();
		var web = $('#webText').val();
		var other = $('#otherText').val();
		var select = $('#selectText').val();
		var id = 'ex-textarea-group' + clickCount;

		if(isUpdate && offset>0){
			html = "<div id='" + id + "' class='textarea-group'><div class=\"form-group\"><label class=\"control-label\" for=\"collocation-examples-entry\">" + eng + "</label><textarea id=\"collocation-examples-entry\" class=\"form-control\" name=\"Collocation[examples]["+offset+"][Entry]\"></textarea></div><div class=\"form-group\"><label class=\"control-label\" for=\"collocation-examples-entryZht\">" + zht + "</label><textarea id=\"collocation-examples-entryZht\" class=\"form-control\" name=\"Collocation[examples]["+offset+"][EntryZht]\"></textarea></div><div class=\"form-group\"><label class=\"control-label\" for=\"collocation-examples-entryZhs\">" + zhs + "</label><textarea id=\"collocation-examples-entryZhs\" class=\"form-control\" name=\"Collocation[examples]["+offset+"][EntryZhs]\"></textarea></div><div class=\"form-group\"><label class=\"control-label\" for=\"collocation-examples-entryJap\">" + jap + "</label><textarea id=\"collocation-examples-entryJap\" class=\"form-control\" name=\"Collocation[examples]["+offset+"][EntryJap]\"></textarea></div><div class=\"form-group field-collocation-examples-source\"><label class=\"control-label\" for=\"collocation-examples-source\">" + source + "</label><select class=\"form-control collocation-examples-source\" name=\"Collocation[examples]["+offset+"][Source]\"><option value=\"1\" selected>" + oxf + "</option><option value=\"2\">" + newd + "</option><option value=\"3\">" + news + "</option><option value=\"4\">" + web + "</option><option value=\"5\">" + other + "</option></select></div><div class=\"form-group field-collocation-examples-remark\"><label class=\"control-label\" for=\"collocation-examples-remark\">" + remark + "</label><textarea id=\"collocation-examples-remark\" class=\"form-control\" name=\"Collocation[examples]["+offset+"][Remark]\"></textarea></div><div class='form-group'><a onclick=\"$('div#" + id + "').detach();\" href=\"#\" class=\"del-ex btn btn-warning create-ex\">" + del + "</a></div></div>";

			offset++;
		}else{
			html = "<div id='" + id + "' class='textarea-group'><div class=\"form-group\"><label class=\"control-label\" for=\"collocation-examples-entry\">" + eng + "</label><textarea id=\"collocation-examples-entry\" class=\"form-control\" name=\"Collocation[examples][][Entry]\"></textarea></div><div class=\"form-group\"><label class=\"control-label\" for=\"collocation-examples-entryZht\">" + zht + "</label><textarea id=\"collocation-examples-entryZht\" class=\"form-control\" name=\"Collocation[examples][][EntryZht]\"></textarea></div><div class=\"form-group\"><label class=\"control-label\" for=\"collocation-examples-entryZhs\">" + zhs + "</label><textarea id=\"collocation-examples-entryZhs\" class=\"form-control\" name=\"Collocation[examples][][EntryZhs]\"></textarea></div><div class=\"form-group\"><label class=\"control-label\" for=\"collocation-examples-entryJap\">" + jap + "</label><textarea id=\"collocation-examples-entryJap\" class=\"form-control\" name=\"Collocation[examples][][EntryJap]\"></textarea></div><div class=\"form-group field-collocation-examples-source\"><label class=\"control-label\" for=\"collocation-examples-source\">" + source + "</label><select class=\"form-control collocation-examples-source\" name=\"Collocation[examples][][Source]\"><option value=\"1\" selected>" + oxf + "</option><option value=\"2\">" + newd + "</option><option value=\"3\">" + news + "</option><option value=\"4\">" + web + "</option><option value=\"5\">" + other + "</option></select></div><div class=\"form-group field-collocation-examples-remark\"><label class=\"control-label\" for=\"collocation-examples-remark\">" + remark + "</label><textarea id=\"collocation-examples-remark\" class=\"form-control\" name=\"Collocation[examples][][Remark]\"></textarea></div><div class='form-group'><a onclick=\"$('div#" + id + "').detach();\" href=\"#\" class=\"del-ex btn btn-warning create-ex\">" + del + "</a></div></div>";
		}

		$('#divCreate').append(html);

	});
}