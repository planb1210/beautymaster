<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>BeautyMaster Authorize</title>
		<link href="/template/css/styles.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<div class="container-header">
			<div class="logo">BeautyMaster</div>
		</div>
		<div class="container-wrapper container">
			<div class="top-content">
				<div class="mask-top-content"></div>
			</div>			
			<div class="content">
				<div class="middle-block">
					<form action="/authorize" method="post">
						<div>Логин:</div>
						<div>
							<input style="width: 100%;" type="text" name="login" />
						</div>
						<div>Пароль:</div>
						<div>
							<input style="width: 100%;" type="password" name="password" />
						</div>
						<input class="button-item button-enable" type="submit" value="Войти" name="submit" />
					</form>
				</div>
			</div>
		</div>
		<div class="container-footer"></div>
	</body>
</html>