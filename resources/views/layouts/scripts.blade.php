<!-- show active pane on navbar -->
<script>
    $(function () {
    setNavigation();
});

function setNavigation() {
    var path = window.location.pathname;
    path = path.replace(/\/$/, "");
    path = decodeURIComponent(path);

    $(".nav a").each(function () {
        var href = $(this).attr('href');
        if (path.substring(0, href.length) === href) {
            $('.nav li').removeClass('active');
            $(this).closest('li').addClass('active');
        }
    });
}
</script>

<!-- choose beteweeing making subfolder or uploading file -->
<script>
	
	$('#selection').on('change', function() {
	    var val = $(this).val();
	    $('#subfolder').hide();
	    $('#file').hide();
	    $('#' + val).show();
	});

</script>

<!-- showing name of file to be uploaded -->
<script>
    $('#customFile').on('change',function(){
        //get the file name
        var fileName = $(this).val();
        var output = fileName.substr(12);
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(output);
    });
</script>

<!-- fade out alert message after 3s -->
<script>
    $('#alert').delay(3000).fadeOut();
</script>

