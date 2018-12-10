# Vion

## Table of contents

- List comming

## Primary functions

### view
```
Controller - Welcome/index
```
```php
$this->vion->view();
```
This function will automatically search your views folder for a folder, with the controllers name and a php file, with the methods name.

### set_data
```
Controller - Welcome/index
```
```php
$some_data = array(
	array(
		'key' => 'data'
	),
	array(
		'key' => 'data'
	)
);
$this->vion->set_data($some_data, 'path', 'to', 'data');
```
```
View - welcome/index.php
```
```html
<div>
	{path}
		{to}
			{data}
				<p>{key}</p>
			{/data}
		{/to}
	{/path}
</div>
```