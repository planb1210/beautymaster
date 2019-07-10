<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Observables в KnockoutJS</title>
</head>
<body>
<div>
<p data-bind="text: name"></p>
<p data-bind="text: name"></p>
</div>
<p><button id="changePhoneBtn">Изменить</button></p>
<script type="text/javascript" src="scripts/knockout-3.5.0.js"></script>
<script type="text/javascript" src="scripts/models/home/properties.js"></script>
<script>
var viewModel = new PropertyModel("fuck fuck");
ko.applyBindings(viewModel);

</script>
</body>
</html>