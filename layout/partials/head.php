<?php 
echo $OUTPUT->doctype() 
?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <script type="text/javascript" src="//use.typekit.net/ull6bqj.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <?php echo $OUTPUT->standard_head_html(); ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui">
</head>