<?php foreach($select_exam->result() as $result) {
?>
<a class="nostyle" href="<?php echo base_url();?>description/index/<?php echo strtolower($result->id_exam);?>">
<div class="col s6 m3 <?php echo str_replace(',',' ',str_replace(" ","",$result->category));?>">
    <div class="card small">
        <div class="card-image waves-effect waves-block waves-light">
            <img alt="<?php echo $result->exam_name; ?>" class="card-image" src="<?php echo base_url(); ?>assets/adm/images/exam/<?php echo $result->exam_image;?>">
        </div>
        <div class="card-content">
            <span class="card-title activator grey-text text-darken-4">
            <?php echo $result->exam_name; ?>
            </span>
            <div class="card-desc">
            <?php echo substr(ucfirst($result->exam_description),0,90). ' ...'; ?>
            </div>
        </div>
    </div>
</div>
</a>
<?php } ?>