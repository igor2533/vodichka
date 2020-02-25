<div>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  


<?php
// запрос

$args = array(
    'posts_per_page' => 50,
    'orderby' => 'date',
    'category_name'=> 'projects',
    'order' => 'asc',
    'year'     => 2020,
);
$query = new WP_Query( $args ); ?>

<?php if ( $query->have_posts() ) : ?>

    <!-- пагинация -->

    <!-- цикл -->


<style type="text/css">
    table#tblData>tbody>tr>td {border: solid 1px black;text-align: center;padding: 2px;}
    tr#head>td {
    font-weight: bold;
}

</style>
</br>
<table  id="tblData" style="border-collapse: collapse; ">
    
    <tr id="head">
        <td>Название проекта</td>
        <td>Жюри 1 Содержание</td>
        <td>Жюри 1 Подача</td>
        <td>Жюри 1 Ср арх</td>
        <td>Жюри 2 Содержание </td>
        <td>Жюри 2 Подача</td>
        <td>Жюри 2 Ср арх</td>
        <td>Общее Ср арх</td>
        <td>BIM</td>
        <td>Оценка итог</td>
        
    </tr>



    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <tr>
        <td><?php the_title(); ?></td>
        <td><?php  echo get_field('оценка_судьи_за_содержание1'); ?></td>
        <td><?php  echo get_field('оценка_за_подачу1'); ?></td>
        <td><?php $sred1 = (get_field('оценка_судьи_за_содержание1')+get_field('оценка_за_подачу1'))/2;  $sred1= str_replace('.',',',$sred1); echo $sred1; ?></td>
        <td><?php  echo get_field('оценка_судьи_за_содержание2'); ?></td>
        <td><?php  echo get_field('оценка_за_подачу2'); ?></td>
        <td><?php $sred2 =  (get_field('оценка_судьи_за_содержание2')+get_field('оценка_за_подачу2'))/2; $sred2= str_replace('.',',',$sred2); echo $sred2; ?></td>
        <td><?php $obw_sr = ($sred1+$sred2)/2; $obw_sr= str_replace('.',',',$obw_sr); echo $obw_sr; ?></td>
        <td><?php  echo get_field('bim'); ?></td>
        <td><?php $itog =  ($obw_sr +get_field('bim'))/2; $itog= str_replace('.',',',$itog); echo $itog;  ?></td>
</tr>
  


    <?php endwhile; ?>
    </table>
    <?php 
$date_today = date("m.d.y");
$today[1] = date("H:i:s"); 
  ?>
    <div style="padding-top: 40px;text-align: center;width: 100%;"> <button style="background: yellow;
    font-size: 20px;
    border: solid 2px green;
    border-radius: 6px;
    font-weight: bold;
    padding: 12px;" onclick="exportTableToExcel('tblData', 'Оценки Export <?php echo($day_today." ". $today[1]);  ?>')">Экспорт в XLS</button> </div>
    <!-- конец цикла -->

    <!-- пагинация -->

    <?php wp_reset_postdata(); ?>

<?php else : ?>
    <p><?php esc_html_e( 'Нет постов по вашим критериям.' ); ?></p>
<?php endif; ?>


</div>



<script> 
function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}

</script>