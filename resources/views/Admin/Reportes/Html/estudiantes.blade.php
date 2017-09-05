<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes</title>
    <!-- Toastr style -->
    <link href="css/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="css/jquery.gritter.css" rel="stylesheet">

</head>
<body>
<div class="" style="margin-bottom: 15px; margin-right: 20px">
        <pre>ESCUELA MILITAR DE INGENIERIA

     LA PAZ - BOLIVIA
        </pre>
</div>
<h2 align="center">Reporte de Estudiantes</h2>
<?php $count = 100 / count($array_keys) ?>
<div class="table table-striped" align="center">
    <table border=3 cellspacing=0 align="center" width="100%">
        <tr>
            <?php foreach($array_keys as $f): ?>
                <th class="success" width="<?php echo($count.'%') ?>"><?php echo($f); ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach($arr as $f): ?>
        <tr align="center">

                <?php foreach($f as $p): ?>
                    <td class="success" width="<?php echo($count.'%') ?>"><?php echo($p); ?></td>
                <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>

    </table>
</div>
<br><br><br>
<?php
date_default_timezone_set('America/La_Paz');
$hoy = getdate();
echo("<pre>");
echo("<p>");
echo("Reporte Generado en Fecha: ".$hoy['mday']."/".$hoy['mon']."/".$hoy['year']."     ".$hoy['hours'].":".$hoy['minutes'].":".$hoy['seconds']);
echo("</p>");
echo("</pre>");
?>
</body>
</html>
