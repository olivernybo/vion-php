# Vion

## Table of contents

- List comming

## Primary functions

### view
> Controller - Welcome/index

```php
$this->vion->view(['template']);
```
This function will automatically search your views folder for a folder, with the controllers name and a php file, with the methods name. It then adds your template aswell.

### seData
> Controller - Welcome/index

```php
$someData = array(
  array(
    'key' => 'data1'
  ),
  array(
    'key' => 'data2'
  )
);
$this->vion->setData($someData, 'path', 'to', 'data');
```

> View - welcome/index.php

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
Will result in:
```html
<div>
  <p>data1</p>
  <p>data2</p>
</div>
```
<div>
  <p>data1</p>
  <p>data2</p>
</div>

## Other functions

### addView
> Controller - Welcome/index

```php
$this->vion->addView('string' || array('of', 'strings') [, 'folder']);
```
This function will add another view to the cue.

### parseViews
> Controller - Welcome/index

```php
$this->vion->parseViews();
```
This function parses the view cue.

### parseView
> Controller - Welcome/index

```php
$this->vion->parseView('html');
```
This function parses a view.

## Properties

### data
```php
$this->vion->data;
```
This property holds all data stored in Vion.

### views
```php
$this->vion->views;
```
This property holds the view cue;