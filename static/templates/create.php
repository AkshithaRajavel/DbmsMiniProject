<?php
echo "
<form action='/api/create' method=post>
        <h3>New $type</h3>
        <div class='container'>
        <input value=$type name='type' hidden >
        <div class='row'>
        <label class='col'>TITLE:</label>
        <input class='col' type='text' name='title' required></div>
        <div class='row'>
        <label class='col'>DESCRIPTION:</label>
        <textarea class='col' rows=7 type='text' name='description' required></textarea></div>
        <div class='row'>
        <label class='col'>IMAGE LINK:</label>
        <textarea class='col' type='text' name='image' required></textarea></div>
        <div class='row'>
        <label class='col'>FEE(in Rs):</label>
        <input class='col' type='number' name='fee' required></div>
        <button type=submit class=btn>+ CREATE</button>
        </div>
        <h3 class='error'>
        </h3>
        </form>
"
?>