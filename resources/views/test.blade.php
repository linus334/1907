<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('doForm')}}" method="post">
		@csrf
		<input type="text" name="name"><br>
		<button>提交</button>
	</form>
</body>
</html> 