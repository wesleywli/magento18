<?
	$string = file_get_contents("list.php");
	$json_a=json_decode($string,true);

?>
<html>
<head>
	<LINK REL=StyleSheet HREF="style.css" TITLE="Contemporary">

<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script>
	$(document).ready(function() {
	// $(window).load(function(){
		$(document).on('click', '.add', function() {
		    // $("form fieldset > p:first-child").clone(true).insertBefore("form fieldset > p:last-child");

		    var strToAdd = '<p><label>Id:</label> <input type="text" name="id" size="3"> <label>Name:</label> <input type="text" name="name" size="5"> <label>Image:</label> <input type="text" name="image" size="50"> <label>Url:</label> <input type="text" name="url" size="50">&nbsp<span class="remove">Remove</span></p>';
		    // console.log(strToAdd);
		    $('#mainField').append(strToAdd);

		    return false;
		});

		$(document).on('click', '.remove', function() {
		    $(this).parent().remove();
		});

		$(document).on('click', '.save', function() {
		    
		    var data = $("form").serializeArray();

		    $.ajax({
			    type: 'POST',
			    data: { obj: data},
			    // dataType: 'json',
			    url: 'save.php'
			});

			$(".status").text(" Saved Time: "+(new Date()) );


		});

	});
</script>
</head>
<body>
	
	<form class="channel" action="save.php" method="post">
		<fieldset id="mainField">
        <legend><h1>Edit eMilk TV Channels list</h1></legend>

	<? foreach($json_a['data'] as $key => $value) { ?>
    <p>
        <label>Id:</label> <input type="text" name="id" size="3" value="<?=$value['id'];?>">
        <label>Name:</label> <input type="text" name="name" size="5" value="<?=$value['name'];?>">
        <label>Image:</label> <input type="text" name="image" size="50" value="<?=$value['image'];?>">
        <label>Url:</label> <input type="text" name="url" size="50" value="<?=$value['url'];?>">
        <span class="remove">Remove</span>
    </p>
    <? } ?>
    
    </fieldset>
    <p>
        <span class="add">Add Channel</span> <span class="save">Save</span> <span class="status"></span>
    </p>
</form>
</body>
</html>